<?php

namespace App\Services\Student;

use App\Exceptions\InvalidValueException;
use App\Models\Course;
use App\Models\StudentCourse;
use App\Models\User;
use App\Services\Print\PrintService;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class StudentService
{
    /**
     * Instance of user service.
     *
     * @var UserService
     */
    public $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get all students.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudents()
    {
        return $this->userService->getUsersByRole('student')->load('studentRecord');
    }

    /**
     * Get all active students.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllActiveStudents()
    {
        return $this->userService->getUsersByRole('student')->load('studentRecord')->filter(function ($student) {
            if ($student->studentRecord) {
                return $student->studentRecord->is_graduated == false;
            }
        });
    }

    /**
     * Get all graduated students.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllGraduatedStudents()
    {
        return $this->userService->getUsersByRole('student')->load('studentRecord')->filter(function ($student) {
            return $student->studentRecord()->withoutGlobalScopes()->first()->is_graduated == true;
        });
    }

    /**
     * Get a student by id.
     *
     * @param array|int $id student id
     *
     * @return \App\Models\User
     */
    public function getStudentById($id)
    {
        return $this->userService->getUserById($id)->load('studentRecord');
    }

    /**
     * Create student.
     *
     * @param array $record Array of student record
     *
     * @return void
     */
    public function createStudent($record)
    {
        DB::transaction(function () use ($record) {
            $student = $this->userService->createUser($record);
            $student->assignRole('student');

            $this->createStudentRecord($student, $record);
        });
    }

    /**
     * Create record for student.
     *
     * @param User         $student $name
     * @param array|object $record
     *
     * @throws InvalidValueException
     *
     * @return void
     */
    public function createStudentRecord(User $student, $record)
    {
        $record['admission_number'] || $record['admission_number'] = $this->generateAdmissionNumber();

        $student->studentRecord()->firstOrCreate([
            'user_id' => $student->id,
        ], [
            'admission_number' => $record['admission_number'],
            'admission_date'   => $record['admission_date'],
        ]);
    }

    /**
     * Update student.
     *
     *
     * @return void
     */
    public function updateStudent(User $student, $records)
    {
        $student = $this->userService->updateUser($student, $records);
    }

    /**
     * Delete student.
     *
     *
     * @return void
     */
    public function deleteStudent(User $student)
    {
        $student->delete();
    }

    /**
     * Print student profile.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function printProfile(string $name, string $view, array $data)
    {
        return PrintService::createPdfFromView($view, $data)->download($name.'.pdf');
    }

    /**
     * Graduate students.
     *
     * @param mixed $records
     *
     * @throws InvalidValueException
     *
     * @return void
     */
    public function graduateStudents($records)
    {
        //get all students for graduation
        $students = $this->getAllActiveStudents()->whereIn('id', $records['student_id']);

        // make sure there are students to graduate
        if (!$students->count()) {
            throw new InvalidValueException('No students to graduate');
        }

        // update each student's graduation status
        foreach ($students as $student) {
            if (in_array($student->id, $records['student_id'])) {
                $student->studentRecord()->update([
                    'is_graduated' => true,
                ]);
            }
        }
    }

    public function getCourses(User $student, string $type): Collection
    {
        $student_id = $student->id;
        if ($type == 'progress') {
            /*
            SELECT C.* FROM courses C INNER JOIN
            (
                SELECT M.course_id, SUM(1) question_nums, SUM(M.is_passed) passed_question_nums, IF(SUM(1) = SUM(M.is_passed), 1, 0) is_completed FROM (
                    SELECT *, IF((R.question_type = 'multi' OR R.question_type = 'boolean') AND R.quiz_option_nums = R.correct_option_nums, 1, IF(R.question_type = 'single' AND R.correct_option_nums = 1, 1, 0)) is_passed FROM (
                        SELECT course_id, question_id, question_text, question_type, points, SUM(1) quiz_option_nums, SUM(exam_result) correct_option_nums FROM (
                                SELECT C.id course_id, Q.id question_id, Q.name question_text, Q.type question_type, Q.points, QO.description, QO.answer, SQ.question_id student_question_id,
                                        SQ.answer student_answer, IF(Q.id = SQ.question_id AND (Q.type = 'multi' OR Q.type = 'boolean') AND QO.answer = SQ.answer, 1,
                                            IF(Q.id = SQ.question_id AND Q.type = 'single', QO.answer * SQ.answer, 0)) exam_result
                                FROM courses C
                                INNER JOIN student_courses SC ON C.id = SC.course_id AND SC.student_id = '31'
                                LEFT JOIN questions Q ON C.id = Q.course_id
                                LEFT JOIN question_options QO ON Q.id = QO.question_id
                                LEFT JOIN student_questions SQ ON C.id = SQ.course_id AND Q.id = SQ.question_id AND QO.id = SQ.question_option_id AND SQ.student_id = '31'
                        ) T GROUP BY T.course_id, T.question_id, T.question_text, T.question_type, T.points
                    ) R
                ) M GROUP BY M.course_id
            ) P ON C.id = P.course_id WHERE P.is_completed = 0 AND C.assigend_id = '$teacher_id'
             */

            $courses =  Course::select('C.*')
                ->from('courses AS C')
                ->joinSub(function ($subquery) use ($student_id) {
                    $subquery->select('M.course_id')
                        ->selectRaw('SUM(1) AS question_nums')
                        ->selectRaw('SUM(M.is_passed) AS passed_question_nums')
                        ->selectRaw('IF(SUM(1) = SUM(M.is_passed), 1, 0) AS is_completed')
                        ->from(function ($subquery) use ($student_id) {
                            $subquery->select('*')
                                ->selectRaw('IF((R.question_type = "multi" OR R.question_type = "boolean") AND R.quiz_option_nums = R.correct_option_nums, 1, IF(R.question_type = "single" AND R.correct_option_nums = 1, 1, 0)) AS is_passed')
                                ->from(function ($subquery) use ($student_id) {
                                    $subquery->select('T.course_id', 'T.question_id', 'T.question_text', 'T.question_type', 'T.points')
                                        ->selectRaw('SUM(1) AS quiz_option_nums')
                                        ->selectRaw('SUM(exam_result) AS correct_option_nums')
                                        ->from(function ($subquery) use ($student_id) {
                                            $subquery->select('C.id AS course_id', 'Q.id AS question_id', 'Q.name AS question_text', 'Q.type AS question_type', 'Q.points', 'QO.description', 'QO.answer', 'SQ.question_id AS student_question_id')
                                                ->selectRaw('SQ.answer AS student_answer')
                                                ->selectRaw('IF(Q.id = SQ.question_id AND (Q.type = "multi" OR Q.type = "boolean") AND QO.answer = SQ.answer, 1, IF(Q.id = SQ.question_id AND Q.type = "single", QO.answer * SQ.answer, 0)) AS exam_result')
                                                ->from('courses AS C')
                                                ->join('student_courses AS SC', 'C.id', '=', 'SC.course_id')
                                                ->leftJoin('questions AS Q', function ($join) {
                                                    $join->on('C.id', '=', 'Q.course_id');
                                                })
                                                ->leftJoin('question_options AS QO', 'Q.id', '=', 'QO.question_id')
                                                ->leftJoin('student_questions AS SQ', function ($join) use ($student_id) {
                                                    $join->on('C.id', '=', 'SQ.course_id')
                                                        ->on('Q.id', '=', 'SQ.question_id')
                                                        ->on('QO.id', '=', 'SQ.question_option_id')
                                                        ->where('SQ.student_id', $student_id);
                                                });
                                        }, 'T')
                                        ->groupBy('T.course_id', 'T.question_id', 'T.question_text', 'T.question_type', 'T.points');
                                }, 'R');
                        }, 'M')
                        ->groupBy('M.course_id');
                }, 'P', function ($join) {
                    $join->on('C.id', '=', 'P.course_id');
                })
                ->where('P.is_completed', 0)
                ->where('C.assigned_id', auth()->user()->id)
                ->with('lessons')
                ->with('questions')
                ->with('assignedTeacher')
                ->get();
        }
        elseif ($type == 'completed') {
            $courses =  Course::select('C.*')
                ->from('courses AS C')
                ->joinSub(function ($subquery) use ($student_id) {
                    $subquery->select('M.course_id')
                        ->selectRaw('SUM(1) AS question_nums')
                        ->selectRaw('SUM(M.is_passed) AS passed_question_nums')
                        ->selectRaw('IF(SUM(1) = SUM(M.is_passed), 1, 0) AS is_completed')
                        ->from(function ($subquery) use ($student_id) {
                            $subquery->select('*')
                                ->selectRaw('IF((R.question_type = "multi" OR R.question_type = "boolean") AND R.quiz_option_nums = R.correct_option_nums, 1, IF(R.question_type = "single" AND R.correct_option_nums = 1, 1, 0)) AS is_passed')
                                ->from(function ($subquery) use ($student_id) {
                                    $subquery->select('T.course_id', 'T.question_id', 'T.question_text', 'T.question_type', 'T.points')
                                        ->selectRaw('SUM(1) AS quiz_option_nums')
                                        ->selectRaw('SUM(exam_result) AS correct_option_nums')
                                        ->from(function ($subquery) use ($student_id) {
                                            $subquery->select('C.id AS course_id', 'Q.id AS question_id', 'Q.name AS question_text', 'Q.type AS question_type', 'Q.points', 'QO.description', 'QO.answer', 'SQ.question_id AS student_question_id')
                                                ->selectRaw('SQ.answer AS student_answer')
                                                ->selectRaw('IF(Q.id = SQ.question_id AND (Q.type = "multi" OR Q.type = "boolean") AND QO.answer = SQ.answer, 1, IF(Q.id = SQ.question_id AND Q.type = "single", QO.answer * SQ.answer, 0)) AS exam_result')
                                                ->from('courses AS C')
                                                ->join('student_courses AS SC', 'C.id', '=', 'SC.course_id')
                                                ->leftJoin('questions AS Q', function ($join) {
                                                    $join->on('C.id', '=', 'Q.course_id');
                                                })
                                                ->leftJoin('question_options AS QO', 'Q.id', '=', 'QO.question_id')
                                                ->leftJoin('student_questions AS SQ', function ($join) use ($student_id) {
                                                    $join->on('C.id', '=', 'SQ.course_id')
                                                        ->on('Q.id', '=', 'SQ.question_id')
                                                        ->on('QO.id', '=', 'SQ.question_option_id')
                                                        ->where('SQ.student_id', $student_id);
                                                });
                                        }, 'T')
                                        ->groupBy('T.course_id', 'T.question_id', 'T.question_text', 'T.question_type', 'T.points');
                                }, 'R');
                        }, 'M')
                        ->groupBy('M.course_id');
                }, 'P', function ($join) {
                    $join->on('C.id', '=', 'P.course_id');
                })
                ->where('P.is_completed', 1)
                ->where('C.assigned_id', auth()->user()->id)
                ->with('lessons')
                ->with('questions')
                ->with('assignedTeacher')
                ->get();
        }
        else {
            $courses = $student->student_courses->load('course.lessons', 'course.questions');
        }

        return $courses;
    }

    public function getStudentsOfTeacher(string $search)
    {
        $students = DB::table('users')
            ->join('student_courses', 'users.id', '=', 'student_courses.student_id')
            ->join('courses', 'student_courses.course_id', '=', 'courses.id')
            ->where('courses.assigned_id', '=', auth()->user()->id)
            ->select('users.*');
        if ($search != '')
            $students = $students->where('users.name', 'LIKE', '%'. $search . '%');

        return $students->distinct();
    }

    public function getStudentCourseProgressPercent(Course $course, User $student): int
    {
        $total_lessons = count($course->lessons);
        $completed_lessons = count($student->student_lessons->where('course_id', $course->id));
        return $total_lessons == 0 ? 0 : intval($completed_lessons / $total_lessons * 100);
    }

    public function getPointsOfStudentExam(int $course_id, int $student_id): int
    {
        $correct_points = 0;

        $query = "
                SELECT id, points, SUM(1) quiz_option_nums, SUM(result) correct_option_nums FROM (
                    SELECT C.title, Q.id, Q.name, Q.points, QO.description, QO.answer, SQ.question_id, SQ.answer student_answer,
                        IF(Q.id = SQ.question_id AND QO.answer = SQ.answer, 1, 0) result
                    FROM courses C
                    INNER JOIN student_courses SC ON C.id = SC.course_id AND SC.student_id = '$student_id'
                    LEFT JOIN questions Q ON C.id = Q.course_id
                    LEFT JOIN question_options QO ON Q.id = QO.question_id
                    LEFT JOIN student_questions SQ ON C.id = SQ.course_id AND Q.id = SQ.question_id AND QO.id = SQ.question_option_id AND SQ.student_id = '$student_id'
                    WHERE C.id = '$course_id'
                ) T GROUP BY T.id";
        $questions = DB::select($query);
        foreach($questions as $question) {
            $correct_points += $question->quiz_option_nums == $question->correct_option_nums ? $question->points : 0;
        }

        return $correct_points;
    }

    public function getCourseCompletedDate(Course $course): string
    {
        $student = auth()->user();
        $completed_date = $student->student_questions()
            ->where('course_id', $course->id)
            ->latest('created_at')
            ->value('created_at');
        return $completed_date ?? 'unknown';
    }

    public function getCourseStartedDate(Course $course): string
    {
        $student = auth()->user();
        $started_date = $student->student_lessons()
            ->where('course_id', $course->id)
            ->min('created_at');
        return $started_date ?? 'unknown';
    }

    public function getStudentUnpaidCourses(string $search)
    {
        $excluded_course_ids = DB::table('student_courses')
            ->where('student_id', auth()->user()->id)
            ->pluck('course_id');

        $courses = Course::select('courses.*')
            ->leftJoin('users', 'courses.assigned_id', '=', 'users.id')
            ->whereNotIn('courses.id', $excluded_course_ids);

        if ($search != '')
            $courses = $courses->where(function ($query) use ($search) {
                $query->where('courses.title', 'LIKE', '%'. $search . '%')
                    ->orWhere('users.name', 'LIKE', '%'. $search . '%');
            });

        return $courses->with('assignedTeacher');
    }

    public function getStudentPaidCourses(string $search)
    {
        $courses = Course::select('courses.*', 'student_courses.created_at AS purchase_at')
            ->join('student_courses', 'courses.id', '=', 'student_courses.course_id')
            ->join('users', 'courses.assigned_id', '=', 'users.id')
            ->where('student_id', auth()->user()->id);

        if ($search != '')
            $courses = $courses->where(function ($query) use ($search) {
                $query->where('courses.title', 'LIKE', '%'. $search . '%')
                    ->orWhere('users.name', 'LIKE', '%'. $search . '%');
            });

        return $courses->with('assignedTeacher');
    }


    public function registerStudentCourse(int $course_id): void
    {
        StudentCourse::create([
            'student_id' => auth()->user()->id,
            'course_id'  => $course_id,
        ]);
    }
}

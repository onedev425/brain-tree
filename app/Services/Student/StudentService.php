<?php

namespace App\Services\Student;

use App\Exceptions\EmptyRecordsException;
use App\Exceptions\InvalidValueException;
use App\Models\Course;
use App\Models\StudentRecord;
use App\Models\User;
use App\Services\MyClass\MyClassService;
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
            SELECT DISTINCT C.* FROM courses C
                INNER JOIN student_courses SC ON C.id = SC.course_id
                LEFT JOIN lessons L ON C.id = L.course_id
                LEFT JOIN student_lessons S ON c.id = S.course_id AND S.lesson_id = L.id AND S.student_id = '$student_id'
            WHERE S.course_id IS NULL AND C.assigned_id = '$teacher_id'
            */

            $courses = Course::select('courses.*')
                ->join('student_courses', function ($join) use ($student_id) {
                    $join->on('courses.id', '=', 'student_courses.course_id')
                        ->where('student_courses.student_id', '=', $student_id);
                })
                ->leftJoin('lessons', 'courses.id', '=', 'lessons.course_id')
                ->leftJoin('student_lessons', function ($join) use ($student_id) {
                    $join->on('courses.id', '=', 'student_lessons.course_id')
                        ->on('student_lessons.lesson_id', '=', 'lessons.id')
                        ->where('student_lessons.student_id', '=', $student_id);
                })
                ->whereNull('student_lessons.course_id')
                ->where('courses.assigned_id', auth()->user()->id)
                ->distinct()
                ->with('lessons')
                ->with('questions')
                ->with('assignedTeacher')
                ->get();
        }
        else {
            /*
             SELECT * FROM courses C
             INNER JOIN student_courses SC ON C.id = SC.course_id AND SC.student_id = '$student_id'
             WHERE SC.course_id NOT IN (
                SELECT DISTINCT C.id FROM courses C
                    INNER JOIN student_courses SC ON C.id = SC.course_id AND SC.student_id = '$student_id'
                    LEFT JOIN lessons L ON C.id = L.course_id
                    LEFT JOIN student_lessons S ON c.id = S.course_id AND S.lesson_id = L.id AND s.student_id = '$student_id'
                WHERE S.course_id IS NULL
            )
             */
            $courses = Course::select('courses.*')
                ->join('student_courses', function ($join) use ($student_id) {
                    $join->on('courses.id', '=', 'student_courses.course_id')
                        ->where('student_courses.student_id', '=', $student_id);
                })
                ->whereNotIn('courses.id', function ($query) use ($student_id) {
                    $query->select('courses.id')
                        ->from('courses')
                        ->join('student_courses', function ($join) use ($student_id) {
                            $join->on('courses.id', '=', 'student_courses.course_id')
                                ->where('student_courses.student_id', '=', $student_id);
                        })
                        ->leftJoin('lessons', 'courses.id', '=', 'lessons.course_id')
                        ->leftJoin('student_lessons', function ($join) use ($student_id) {
                            $join->on('courses.id', '=', 'student_lessons.course_id')
                                ->on('lessons.id', '=', 'student_lessons.lesson_id')
                                ->where('student_lessons.student_id', '=', $student_id);
                        })
                        ->whereNull('student_lessons.course_id');
                })
                ->where('courses.assigned_id', auth()->user()->id)
                ->get();
        }

        return $courses;
    }

    public function getStudentCourseProgressPercent(Course $course, User $student): int
    {
        $total_lessons = count($course->lessons);
        $completed_lessons = count($student->student_lessons->where('course_id', $course->id));
        return $total_lessons == 0 ? 0 : intval($completed_lessons / $total_lessons * 100);
    }
}

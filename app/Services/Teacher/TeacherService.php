<?php

namespace App\Services\Teacher;

use App\Models\User;
use App\Models\Course;
use App\Services\Print\PrintService;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TeacherService
{
    /**
     * User service variable.
     */
    public userService $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    /**
     * Get all teachers.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTeachers()
    {
        return $this->user->getUsersByRole('teacher')->load('teacherRecord');
    }

    /**
     * Create a new teacher.
     *
     * @param Collection|array $record
     *
     * @return void
     */
    public function createTeacher($record)
    {
        $teacher = $this->user->createUser($record);
        $teacher->assignRole('teacher');
    }

    /**
     * Update a teacher.
     *
     * @param array|object|collection $records
     *
     * @return void
     */
    public function updateTeacher(User $teacher, $records)
    {
        $this->user->updateUser($teacher, $records, 'teacher');
    }

    /**
     * Delete teacher.
     *
     *
     * @return void
     */
    public function deleteTeacher(User $teacher)
    {
        $this->user->deleteUser($teacher);
    }

    /**
     * Print a user profile.
     *
     *
     * @return mixed
     */
    public function printProfile(string $name, string $view, array $data)
    {
        return PrintService::createPdfFromView($view, $data);
    }

    public function getStudentMarksOfTeacher(string $search)
    {
        /*
        SELECT U.id student_id, U.name student_name, U.profile_photo_path student_photo, C.title, M.total_points, M.student_points FROM users U
        INNER JOIN (
            SELECT P.student_id, P.course_id, SUM(P.points) total_points, SUM(P.points * P.is_passed) student_points FROM (
                SELECT *, IF((R.question_type = 'multi' OR R.question_type = 'boolean') AND R.quiz_option_nums = R.correct_option_nums, 1, IF(R.question_type = 'single' AND R.correct_option_nums = 1, 1, 0)) is_passed FROM (
                    SELECT T.student_id, T.course_id, T.question_id, T.question_type, T.points, SUM(1) quiz_option_nums, SUM(exam_result) correct_option_nums FROM (
                        SELECT SQ.student_id, SQ.course_id, SQ.question_id, Q.name question, Q.type question_type, Q.points, QO.id question_option_id, QO.description, QO.answer, SQ.answer student_answer,
                            IF(Q.id = SQ.question_id AND (Q.type = 'multi' OR Q.type = 'boolean') AND QO.answer = SQ.answer, 1,
                                IF(Q.id = SQ.question_id AND Q.type = 'single', QO.answer * SQ.answer, 0)) exam_result
                        FROM student_questions SQ
                        LEFT JOIN question_options QO ON SQ.question_option_id = QO.id
                        LEFT JOIN questions Q ON SQ.question_id = Q.id
                    ) T GROUP BY T.student_id, T.course_id, T.question_id, T.question_type, T.points
                ) R
            ) P GROUP BY P.student_id, P.course_id
        ) M ON U.id = M.student_id
        INNER JOIN courses C ON M.course_id = C.id
        WHERE C.assigned_id = '$teacher_id' AND (U.name like '%sss%' OR C.title like '%wwww%')
         */
        $teacher_id = auth()->user()->id;
        $students = DB::table('users as U')
            ->select('U.id as student_id', 'U.name as student_name', 'U.profile_photo_path as student_photo', 'C.id as course_id', 'C.title as course_title', 'M.total_points', 'M.student_points')
            ->join(DB::raw('(
                    SELECT P.student_id, P.course_id, SUM(P.points) as total_points, SUM(P.points * P.is_passed) as student_points FROM (
                        SELECT *, IF((R.question_type = "multi" OR R.question_type = "boolean") AND R.quiz_option_nums = R.correct_option_nums, 1, IF(R.question_type = "single" AND R.correct_option_nums = 1, 1, 0)) as is_passed FROM (
                            SELECT T.student_id, T.course_id, T.question_id, T.question_type, T.points, SUM(1) as quiz_option_nums, SUM(exam_result) as correct_option_nums FROM (
                                SELECT SQ.student_id, SQ.course_id, SQ.question_id, Q.name as question, Q.type as question_type, Q.points, QO.id as question_option_id, QO.description, QO.answer, SQ.answer as student_answer,
                                    IF(Q.id = SQ.question_id AND (Q.type = "multi" OR Q.type = "boolean") AND QO.answer = SQ.answer, 1,
                                        IF(Q.id = SQ.question_id AND Q.type = "single", QO.answer * SQ.answer, 0)) as exam_result
                                FROM student_questions SQ
                                LEFT JOIN question_options QO ON SQ.question_option_id = QO.id
                                LEFT JOIN questions Q ON SQ.question_id = Q.id
                            ) T GROUP BY T.student_id, T.course_id, T.question_id, T.question_type, T.points
                        ) R
                    ) P GROUP BY P.student_id, P.course_id
                ) M'), 'U.id', '=', 'M.student_id')
            ->join('courses as C', 'M.course_id', '=', 'C.id');

        if (auth()->user()->hasRole('teacher'))
            $students = $students->where('C.assigned_id', '=', $teacher_id);

        if ($search != '')
            $students = $students->where(function ($query) use ($search) {
                $query->where('U.name', 'LIKE', '%'. $search . '%')
                    ->orWhere('C.title', 'LIKE', '%'. $search . '%');
            });

        return $students;
    }

    public function getSoldCourses(string $search)
    {
        $courses = Course::select('courses.*', 'student_courses.created_at AS purchase_at', 'users.name AS student_name')
            ->join('student_courses', 'courses.id', '=', 'student_courses.course_id')
            ->join('users', 'student_courses.student_id', '=', 'users.id');

        if (auth()->user()->hasRole('teacher'))
            $courses = $courses->where('courses.assigned_id', auth()->user()->id);

        if ($search != '')
            $courses = $courses->where(function ($query) use ($search) {
                $query->where('courses.title', 'LIKE', '%'. $search . '%')
                    ->orWhere('users.name', 'LIKE', '%'. $search . '%');
            });

        return $courses->with('assignedTeacher');
    }
}

<?php

namespace App\Services\Student;

use App\Exceptions\EmptyRecordsException;
use App\Exceptions\InvalidValueException;
use App\Models\Promotion;
use App\Models\School;
use App\Models\StudentRecord;
use App\Models\User;
use App\Services\MyClass\MyClassService;
use App\Services\Print\PrintService;
use App\Services\User\UserService;
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
     * Get all students in school.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudents()
    {
        return $this->userService->getUsersByRole('student')->load('studentRecord');
    }

    /**
     * Get all active students in school.
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
     * Get all graduated students in school.
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
     * Generate admission number.
     *
     * @return string
     */
    public function generateAdmissionNumber($schoolId = null)
    {
        $schoolInitials = (School::find($schoolId) ?? auth()->user()->school)->initials;
        $schoolInitials != null && $schoolInitials .= '/';
        $currentYear = date('y');
        do {
            $admissionNumber = "$schoolInitials"."$currentYear/".\mt_rand('100000', '999999');
            if (StudentRecord::where('admission_number', $admissionNumber)->count() <= 0) {
                $uniqueAdmissionNumberFound = true;
            } else {
                $uniqueAdmissionNumberFound = false;
            }
        } while ($uniqueAdmissionNumberFound == false);

        return $admissionNumber;
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

    /**
     * Reset Graduation.
     *
     *
     * @return void
     */
    public function resetGraduation(User $student)
    {
        $student->graduatedStudentRecord()->update([
            'is_graduated' => false,
        ]);
    }
}

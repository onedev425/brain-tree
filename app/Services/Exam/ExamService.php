<?php

namespace App\Services\Exam;

use App\Exceptions\EmptyRecordsException;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ExamService
{
    /**
     * @var ExamRecordService
     */
    protected $examRecordService;

    /**
     * @var ExamSlotService
     */
    protected $examSlotService;

    public function __construct(ExamRecordService $examRecordService, ExamSlotService $examSlotService)
    {
        $this->examRecordService = $examRecordService;
        $this->examSlotService = $examSlotService;
    }

    /**
     * get an exam by it's id.
     *
     *
     * @return \App\Models\Exam
     */
    public function getExamById(int $id)
    {
        return Exam::find($id);
    }

    /**
     * Create exam.
     *
     * @param array|object $records
     *
     * @return Exam
     */
    public function createExam($records)
    {
        $exam = Exam::create([
            'name'        => $records['name'],
            'description' => $records['description'],
            'start_date'  => $records['start_date'],
            'stop_date'   => $records['stop_date'],
        ]);

        return $exam;
    }

    /**
     * Update an exam.
     *
     * @param array|object $records
     *
     * @return void
     */
    public function updateExam(Exam $exam, $records)
    {
        $exam->name = $records['name'];
        $exam->description = $records['description'];
        $exam->start_date = $records['start_date'];
        $exam->stop_date = $records['stop_date'];
        $exam->save();
    }

    /**
     * set if exam is active or not .
     *
     *
     * @return void
     */
    public function setExamActiveStatus(Exam $exam, bool $active)
    {
        $exam->active = $active;
        $exam->save();
    }

    /**
     * Set result publish status for exam.
     *
     *@throws
     *
     * @return void
     */
    public function setPublishResultStatus(Exam $exam, bool $status)
    {
        if ($exam->examSlots()->count() <= 0 && $status == 1) {
            throw new EmptyRecordsException('Cannot publish result for exam without exam slots', 1);
        }

        $exam->publish_result = $status;
        $exam->save();
    }

    /**
     * Delete exam.
     *
     *
     * @return void
     */
    public function deleteExam(Exam $exam)
    {
        $exam->delete();
    }

    /**
     * Calculate total marks attainable in each subjects for an exam.
     *
     *
     * @return int
     */
    public function totalMarksAttainableInExamForSubject(Exam $exam)
    {
        $totalMarks = 0;
        foreach ($exam->examSlots as $examSlot) {
            $totalMarks += $examSlot->total_marks;
        }

        return $totalMarks;
    }

    /**
     * Calculate total marks attainale accross all subjects in an exam.
     *
     *
     * @return int
     */
    public function calculateStudentTotalMarksInSubject(Exam $exam, User $user, Subject $subject)
    {
        return $this->examRecordService->getAllUserExamRecordInExamForSubject($exam, $user->id, $subject->id)->pluck('student_marks')->sum();
    }

}

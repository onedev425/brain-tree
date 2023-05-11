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
     * @var ExamSlotService
     */
    protected $examSlotService;

    public function __construct(ExamSlotService $examSlotService)
    {
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
}

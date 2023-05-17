<?php

namespace App\Traits;

use App\Models\GradeSystem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

/**
 * Mark tabulation traits.
 */
trait MarkTabulationTrait
{
    /**
     * Highest amount of marks a student can get.
     */
    public int $totalMarksAttainableInEachSubject;

    /**
     * A collection of all subjects used in tabulation creation.
     *
     * @var Collection<Subjects>
     */
    public Collection $subjects;

    public Collection $students;

    /**
     * @param Collection<int, \App\Models\Subject>  $subjects
     * @param Collection<int, \App\Models\Student>  $students
     * @param Collection<int, \App\Models\ExamSlot> $examSlots
     *
     * @return Collection
     */
    public function tabulateMarks(Collection|SupportCollection $subjects, Collection|SupportCollection $students, Collection|SupportCollection $examSlots)
    {
        //create tabulation container variable
        $tabulatedRecords = [];

        $grades = GradeSystem::get();
        $totalMarksAttainableInEachSubject = $examSlots->sum(['total_marks']);

        //set public variables
        $this->totalMarksAttainableInEachSubject = $totalMarksAttainableInEachSubject;
        $this->subjects = $subjects;
        $this->students = $students;

        //eager load relevant resources
        $students->load('studentRecord');

        foreach ($students as $student) {
            //array to hold tabulation values for each student
            $totalSubjectMarks = [];

            //set student name and admission number
            $tabulatedRecords[$student->id]['student_name'] = $student->name;
            $tabulatedRecords[$student->id]['admission_number'] = $student->studentRecord->admission_number;

            //turned to object
            $totalSubjectMarks = collect($totalSubjectMarks)->sum();

            //set total from summing each subject
            $tabulatedRecords[$student->id]['total'] = $totalSubjectMarks;

            //calculated percentage
            $totalMarks = $totalMarksAttainableInEachSubject * $subjects->count();

            //make sure total marks is not 0
            $totalMarks = $totalMarks ? $totalMarks : 1;
            $tabulatedRecords[$student->id]['percent'] = ceil(($totalSubjectMarks / $totalMarks) * 100);
            $percentage = $tabulatedRecords[$student->id]['percent'];
            $grade = $grades->where('grade_from', '<=', $percentage)->where('grade_till', '>=', $percentage)->first();

            //get appropriate grade
            $tabulatedRecords[$student->id]['grade'] = $grade ? $grade->name : 'No Grade';
        }

        return collect($tabulatedRecords);
    }
}

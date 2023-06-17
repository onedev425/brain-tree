<?php

namespace App\Http\Livewire;

use App\Services\Teacher\TeacherService;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use App\Models\User;
use App\Models\StudentQuestion;

class MarksTable extends Component
{
    use WithPagination;
    public string $unique_id;
    public string $search = '';
    public int $per_page = 10;
    private TeacherService $teacherService;

    public function mount(TeacherService $teacherService, $unique_id = null, $per_page = 10)
    {
        $this->teacherService = $teacherService;
        $this->unique_id = $unique_id ?? Str::random(10);
        $this->per_page = $per_page;
    }

    public function paginationView()
    {
        return 'components.datatable-pagination-links-view';
    }

    public function render()
    {
        if (!isset($this->teacherService)) {
            $this->teacherService = app(TeacherService::class);
        }
        $students = $this->teacherService->getStudentMarksOfTeacher($this->search);
        $students = $students->paginate(10);

        return view('livewire.marks-table', [
            'students' => $students,
        ]);
    }

    public function getQuestionInformationOfCourse($course_id, $student_id): string
    {
        $course = Course::with('questions.quiz_options')->find($course_id);
        $questions = $course->questions;

        $quiz_info = [];
        foreach($questions as $question) {
            $quiz_option_info = [];
            $quiz_options = $question->quiz_options;

            foreach($quiz_options as $quiz_option) {
                // get the student's answer
                $student_answer = StudentQuestion::all()
                    ->where('student_id', $student_id)
                    ->where('course_id', $course->id)
                    ->where('question_id', $question->id)
                    ->where('question_option_id', $quiz_option->id)->first();
                $student_answer = $student_answer ? $student_answer->answer : null;

                $quiz_answer_info = new \stdClass();
                $quiz_answer_info->text = $quiz_option->description;
                $quiz_answer_info->correct_answer = $quiz_option->answer;
                $quiz_answer_info->student_answer = $student_answer;
                $quiz_option_info[] = $quiz_answer_info;
            }

            $question_info = new \stdClass();
            $question_info->text = $question->name;
            $question_info->type = $question->type;
            $question_info->points = $question->points;
            $question_info->quiz_options = $quiz_option_info;
            $quiz_info[] = $question_info;
        }

        return json_encode($quiz_info);
    }
}

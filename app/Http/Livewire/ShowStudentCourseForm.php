<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\Topic;
use App\Services\Course\CourseService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowStudentCourseForm extends Component
{
    public array $activeQuiz = [];
    public string $activeTab = 'Resources';
    public Course $course;
    public Collection $topics;
    public Collection $quizzes;
    public bool $passed_exam;
    private CourseService $courseService;
    
    // public function mount(CourseService $courseService): void
    // {
    //     $this->courseService = $courseService;
    // }

    public function boot(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }
    
    public function setTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.show-student-course-form');
    }

    public function getTopicVideoDuration(Topic $topic): string
    {
        return $this->courseService->getTopicVideoDuration($topic);
    }

    public function getLessonVideoDuration(int $lesson_video_duration): string
    {
        return $this->courseService->getLessonVideoDuration($lesson_video_duration);
    }

    public function getVideoEmbedURL(string $video_type, string $video_url): string
    {
        return $video_type == 'youtube' ? $this->courseService->getYoutubeEmbedURL($video_url) : $this->courseService->getVimeoEmbedURL($video_url);
    }

    public function isLessonCompleted($lesson_id): bool
    {
        return $this->courseService->isLessonCompleted($lesson_id);
    }

    public function isAllLessonCompleted(Course $course): bool
    {
        return $this->courseService->isAllLessonCompleted($course);
    }

    public function isQuestionCompleted($question_id): bool
    {
        return $this->courseService->isQuestionCompleted($question_id);
    }
}

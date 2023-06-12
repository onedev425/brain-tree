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
    public Course $course;
    public Collection $topics;
    public Collection $quizzes;
    private CourseService $courseService;

    public function mount(CourseService $courseService): void
    {
        $this->courseService = $courseService;
    }
    public function setQuiz($quiz_id)
    {
        if (in_array($quiz_id, $this->activeQuiz))
            $this->activeQuiz = array_diff($this->activeQuiz, array($quiz_id));
        else
            $this->activeQuiz[] = $quiz_id;
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
}

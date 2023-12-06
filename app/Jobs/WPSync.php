<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Industry;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Services\Course\CourseService;

class WPSync implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected User $user;
    protected $courses;
    protected CourseService $courseService;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $courses, $courseService)
    {
        $this->user = $user;
        $this->courses = $courses;
        $this->courseService = $courseService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client();

        foreach($this->courses as $course) {
            $industry = Industry::find($course->industry_id);
            $lessons = $course->lessons()->get();
            $questions = $course->questions()->get();

            $video_duration = Lesson::selectRaw('SUM(video_duration) as total_duration')
                ->where('course_id', $course->id)
                ->value('total_duration');
            $video_duration = is_null($video_duration) ? 0 : $this->courseService->convertDurationFromSeconds($video_duration);

            try {
                $response = $client->request('POST', env('WP_API_SYNC_BASE_URL') . "/wp-json/sync-api/v1/course/update", [
                    'form_params' => [
                        'id' => $course->wp_course_id,
                        'title' => $course->title,
                        'description' => $course->description,
                        'post_excerpt' => $course->description,
                        'category' => $industry->name,
                        'cost' => $course->price,
                        'instructor' => $course->assignedTeacher->name,
                        'post_status' => $course->is_published,
                        'featured_image' => $course->image,
                        'rating' => $course->course_rate(),
                        'duration' => $video_duration,
                        'lessons' => count($lessons),
                        'questions' => count($questions)
                    ],
                ]);

                $responseBody = $response->getBody()->getContents();
                $data = json_decode($responseBody, true);
                $courseId = null;

                if (isset($data['course_id'])) {
                    $courseId = $data['course_id'];
                    $course->forceFill([
                        'wp_course_id' => $courseId
                    ])->save();
                }
            } catch(\Exception $e) {
                Log::error('An error occurred: ' . $e->getMessage(), [
                    'exception' => $e,
                ]);
            }
        }
    }
}

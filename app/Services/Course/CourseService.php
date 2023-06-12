<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\Topic;
use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;
use Google_Client;
use Google_Service_YouTube;
use GuzzleHttp\Client;

class CourseService
{
    /**
     * Get courses.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCourses($type): Collection
    {
        if ($type == 'publish')
            $courses = Course::with('lessons')->where('is_published', 1)->get();
        elseif ($type == 'draft')
            $courses = Course::with('lessons')->where('is_published', 0)->get();
        elseif ($type == 'progress') {
            /*
            SELECT DISTINCT c.*
            FROM courses c
            LEFT JOIN student_lessons s ON c.id = s.course_id AND s.student_id = '31'
            WHERE s.course_id IS NULL

            UNION

            SELECT DISTINCT c.*
            FROM courses c
            RIGHT JOIN student_lessons s ON c.id = s.course_id AND s.student_id = '31'
            WHERE c.id IS NULL
            */

            $student_id = auth()->user()->id;
            $courses = Course::select('courses.*')
                ->leftJoin('student_lessons', function ($join) use ($student_id) {
                    $join->on('courses.id', '=', 'student_lessons.course_id')
                        ->where('student_lessons.student_id', '=', $student_id);
                })
                ->whereNull('student_lessons.course_id')
                ->orWhere(function ($query) {
                    $query->rightJoin('student_lessons', 'courses.id', '=', 'student_lessons.course_id')
                        ->whereNull('courses.id');
                })
                ->with('lessons')
                ->with('questions')
                ->with('assignedTeacher')
                ->distinct()
                ->get();
        }
        else
            $courses = Course::join('student_lessons', 'courses.id', '=', 'student_lessons.course_id')
                ->where('student_lessons.student_id', auth()->user()->id)
                ->distinct()
                ->get(['courses.*']);

        return $courses;
    }

    public function getCourseVideoDuration(Course $course): string
    {
        $video_duration = Lesson::selectRaw('SUM(video_duration) as total_duration')
            ->where('course_id', $course->id)
            ->value('total_duration');

        return $this->convertDurationFromSeconds($video_duration);
    }

    public function getTopicVideoDuration(Topic $topic): string
    {
        $video_duration = Lesson::selectRaw('SUM(video_duration) as total_duration')
            ->where('topic_id', $topic->id)
            ->value('total_duration');

        return is_null($video_duration) ? '-' : $this->convertDurationFromSeconds($video_duration);
    }

    public function getLessonVideoDuration(int $video_duration): string
    {
        return $this->convertDurationFromSeconds($video_duration);
    }
    /**
     * Get a course by Id.
     *
     *
     * @return \App\Models\Subject
     */
    public function getCourseId(int $id): Course
    {
        return Course::find($id);
    }

    /**
     * Create course.
     *
     * @param mixed $data
     *
     * @return void
     */
    public function createCourse($data): void
    {
        $course = Course::create([
            'title' => $data['course_title'],
            'price'  => $data['course_price'],
            'description'  => $data['course_description'],
            'industry_id'  => $data['industry_id'],
            'image'  => $data['course_image'],
            'created_by'  => auth()->user()->id,
            'assigned_id'  => auth()->user()->id,
            'quiz_active'  => $data['quiz_active'],
            'is_published'  => $data['is_published'],
        ]);

        foreach($data['topic_list'] as $topic_info) {
            $topic = $course->topics()->create([
                'description' => $topic_info['title'],
                'user_id' => auth()->user()->id
            ]);

            foreach($topic_info['lessons'] as $lesson_info) {
                $topic->lessons()->create([
                    'title' => $lesson_info['title'],
                    'description' => $lesson_info['description'],
                    'video_type' => $lesson_info['video_source'],
                    'video_link' => $lesson_info['video_url'],
                    'video_duration' => $this->getVideoLength($lesson_info['video_source'], $lesson_info['video_url']),
                    'user_id' => auth()->user()->id,
                    'course_id' => $course->id,
                ]);
            }
        }

        foreach ($data['quiz_list'] as $quiz_info) {
            $question = $course->questions()->create([
                'name' => $quiz_info['title'],
                'description' => $quiz_info['description'],
                'user_id' => auth()->user()->id,
                'type' => $quiz_info['type'],
                'points' => $quiz_info['points']
            ]);

            $answers = explode('$$$', $quiz_info['answer']);
            $answer_values = explode('$$$', $quiz_info['answer_values']);
            foreach($answers as $key => $answer) {
                $question->quiz_options()->create([
                    'description' => $answer,
                    'answer' => $answer_values[$key]
                ]);
            }
        }
    }

    public function updateCourse($data): void
    {
        // update a selected course
        $course = $data['course'];
        $course->fill([
            'title' => $data['course_title'],
            'price'  => $data['course_price'],
            'description'  => $data['course_description'],
            'industry_id'  => $data['industry_id'],
            'image'  => $data['course_image'],
            'quiz_active'  => $data['quiz_active'],
            'is_published'  => $data['is_published'],
        ]);
        $course->save();


        // if some topics removed from UI, remove the topics from database
        $topic_ids = [];
        foreach($data['topic_list'] as $topic_info) {
            $topic_ids[] = $topic_info['id'];
        }
        $course->topics()->whereNotIn('id', $topic_ids)->delete();

        // Create/Update topics/lessons
        foreach($data['topic_list'] as $topic_info) {
            if ($topic_info['id'] == 0) {
                $topic = $course->topics()->create([
                    'description' => $topic_info['title'],
                    'user_id' => auth()->user()->id
                ]);
            }
            else {
                $topic = Topic::find($topic_info['id']);
                $topic->fill(['description' => $topic_info['title']]);
                $topic->save();
            }

            // if some lessons removed from UI, remove the lessons from database
            $lesson_ids = [];
            foreach($topic_info['lessons'] as $lesson_info) {
                $lesson_ids[] = $lesson_info['id'];
            }
            $topic->lessons()->whereNotIn('id', $lesson_ids)->delete();

            foreach($topic_info['lessons'] as $lesson_info) {
                if ($lesson_info['id'] == 0) {
                    $topic->lessons()->create([
                        'title' => $lesson_info['title'],
                        'description' => $lesson_info['description'],
                        'video_type' => $lesson_info['video_source'],
                        'video_link' => $lesson_info['video_url'],
                        'video_duration' => $this->getVideoLength($lesson_info['video_source'], $lesson_info['video_url']),
                        'user_id' => auth()->user()->id,
                        'course_id' => $course->id,
                    ]);
                }
                else {
                    $lesson = Lesson::find($lesson_info['id']);
                    $lesson->fill([
                        'title' => $lesson_info['title'],
                        'description' => $lesson_info['description'],
                        'video_type' => $lesson_info['video_source'],
                        'video_link' => $lesson_info['video_url'],
                        'video_duration' => $this->getVideoLength($lesson_info['video_source'], $lesson_info['video_url']),
                    ]);
                    $lesson->save();
                }
            }
        }

        // if some topics removed from UI, remove the topics from database
        $quiz_ids = [];
        foreach($data['quiz_list'] as $quiz_info) {
            $quiz_ids[] = $quiz_info['id'];
        }
        $course->questions()->whereNotIn('id', $quiz_ids)->delete();

        foreach ($data['quiz_list'] as $quiz_info) {
            if ($quiz_info['id'] == 0) {
                $question = $course->questions()->create([
                    'name' => $quiz_info['title'],
                    'description' => $quiz_info['description'],
                    'user_id' => auth()->user()->id,
                    'type' => $quiz_info['type'],
                    'points' => $quiz_info['points']
                ]);
            }
            else {
                $question = Question::find($quiz_info['id']);
                $question->fill([
                    'name' => $quiz_info['title'],
                    'description' => $quiz_info['description'],
                    'type' => $quiz_info['type'],
                    'points' => $quiz_info['points']
                ]);
                $question->save();
            }

            $question->quiz_options()->delete();

            $answers = explode('$$$', $quiz_info['answer']);
            $answer_values = explode('$$$', $quiz_info['answer_values']);
            foreach($answers as $key => $answer) {
                $question->quiz_options()->create([
                    'description' => $answer,
                    'answer' => $answer_values[$key]
                ]);
            }
        }

    }

    public function deleteCourseImage($image_path): void
    {
        $image_name = basename($image_path);
        if ($image_name != 'course.jpg')
            unlink(public_path('upload/course/') . $image_name);
    }

    public function getYoutubeEmbedURL(string $video_url): string
    {
        $video_id = $this->getYoutubeVideoIdFromUrl($video_url);
        return 'https://www.youtube.com/embed/' . $video_id;
    }

    public function getVimeoEmbedURL(string $video_url): string
    {
        $video_id = $this->getVimeoIdFromUrl($video_url);
        return 'https://player.vimeo.com/video/' . $video_id;
    }

    private function convertDurationFromSeconds(int $video_duration): string
    {
        $hours = floor($video_duration / 3600);
        $minutes = floor(($video_duration / 60) % 60);
        $seconds = $video_duration % 60;

        $formatted_minutes = str_pad(strval($minutes), 2, '0', STR_PAD_LEFT);
        $formatted_seconds = str_pad(strval($seconds), 2, '0', STR_PAD_LEFT);

        if ($hours == 0)
            return $formatted_minutes . 'm ' . $formatted_seconds . 's';
        else
            return $hours .'h ' . $formatted_minutes . 'm ' . $formatted_seconds . 's';
    }

    private function getVideoLength($video_type, $video_url): int
    {
        $video_duration = 0;
        if ($video_type == 'youtube') {
            $client = new Google_Client();
            $client->setDeveloperKey(env('GOOGLE_API_KEY'));

            $youtube = new Google_Service_YouTube($client);
            $video_id = $this->getYoutubeVideoIdFromUrl($video_url);

            if ($video_id != '') {
                $response = $youtube->videos->listVideos('contentDetails', ['id' => $video_id]);
                $duration = $response['items'][0]['contentDetails']['duration'];

                // Parse the duration into seconds
                preg_match('/PT(\d+H)?(\d+M)?(\d+S)?/', $duration, $matches);
                $hours = isset($matches[1]) ? intval(str_replace('H', '', $matches[1])) * 3600 : 0;
                $minutes = isset($matches[2]) ? intval(str_replace('M', '', $matches[2])) * 60 : 0;
                $seconds = isset($matches[3]) ? intval(str_replace('S', '', $matches[3])) : 0;
                $video_duration = $hours + $minutes + $seconds;
            }

        }
        elseif ($video_type == 'vimeo') {
            $client = new Client();
            $video_id = $this->getVimeoIdFromUrl($video_url);
            if ($video_id != '') {
                $response = $client->request('GET', "https://api.vimeo.com/videos/$video_id", [
                    'headers' => [
                        'Authorization' => 'Bearer ' . env('VIMEO_ACCESS_TOKEN'),
                        'Accept' => 'application/vnd.vimeo.*+json;version=3.4',
                    ],
                ]);
                $data = json_decode($response->getBody(), true);
                $video_duration = $data['duration'];
            }

        }
        return $video_duration;
    }

    private function getYoutubeVideoIdFromUrl($url): string
    {
        $regex_pattern = '/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|vi|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($regex_pattern, $url, $matches);

        return empty($matches[1]) ? '' : $matches[1];
    }

    private function getVimeoIdFromUrl($url): string
    {
        $parsedUrl = parse_url($url);

        if (isset($parsedUrl['host']) && $parsedUrl['host'] === 'vimeo.com') {
            $path = ltrim($parsedUrl['path'], '/');
            if (is_numeric($path)) {
                return $path;
            } elseif (preg_match('/\/(\d+)/', $path, $matches)) {
                return $matches[1];
            }
        }
        return '';
    }


}

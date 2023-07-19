<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\Topic;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
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
    public function getCourses(string $type, $assigned_teacher = null): Collection
    {
        if ($type == 'publish')
            if (auth()->user()->hasRole('super-admin') && $assigned_teacher == null)
                $courses = Course::with('lessons')->where('is_published', 1)->get();
            else {
                $assigned_id = $assigned_teacher == null ? auth()->user()->id : $assigned_teacher->id;
                $courses = Course::with('lessons')->where('is_published', 1)->where('assigned_id', $assigned_id)->get();
            }
        elseif ($type == 'draft')
            if (auth()->user()->hasRole('super-admin'))
                if ($assigned_teacher == null)
                    $courses = Course::with('lessons')->where('is_published', 0)->where('is_declined', 0)->get();
                else
                    $courses = Course::with('lessons')->where('is_published', 0)->where('is_declined', 0)->where('assigned_id', $assigned_teacher->id)->get();
            else {
                $courses = Course::with('lessons')->where('is_published', 0)->where('assigned_id', auth()->user()->id)->get();
            }

        elseif ($type == 'progress') {
            /*
            SELECT C.* FROM courses C INNER JOIN
            (
                SELECT M.course_id, SUM(1) question_nums, SUM(M.is_passed) passed_question_nums, IF(SUM(M.is_passed) / SUM(1) * 100 > M.pass_percent, 1, 0) is_completed FROM (
                    SELECT *, IF((R.question_type = 'multi' OR R.question_type = 'boolean') AND R.quiz_option_nums = R.correct_option_nums, 1, IF(R.question_type = 'single' AND R.correct_option_nums = 1, 1, 0)) is_passed FROM (
                        SELECT course_id, pass_percent, question_id, question_text, question_type, points, SUM(1) quiz_option_nums, SUM(exam_result) correct_option_nums FROM (
                                SELECT C.id course_id, C.pass_percent, Q.id question_id, Q.name question_text, Q.type question_type, Q.points, QO.description, QO.answer, SQ.question_id student_question_id,
                                        SQ.answer student_answer, IF(Q.id = SQ.question_id AND (Q.type = 'multi' OR Q.type = 'boolean') AND QO.answer = SQ.answer, 1,
                                            IF(Q.id = SQ.question_id AND Q.type = 'single', QO.answer * SQ.answer, 0)) exam_result
                                FROM courses C
                                INNER JOIN student_courses SC ON C.id = SC.course_id AND SC.student_id = '31'
                                LEFT JOIN questions Q ON C.id = Q.course_id
                                LEFT JOIN question_options QO ON Q.id = QO.question_id
                                LEFT JOIN student_questions SQ ON C.id = SQ.course_id AND Q.id = SQ.question_id AND QO.id = SQ.question_option_id AND SQ.student_id = '31'
                        ) T GROUP BY T.course_id, T.pass_percent, T.question_id, T.question_text, T.question_type, T.points
                    ) R
                ) M GROUP BY M.course_id, M.pass_percent
            ) P ON C.id = P.course_id WHERE P.is_completed = 0
             */
            $student_id = auth()->user()->id;
            $courses =  Course::select('C.*')
                ->from('courses AS C')
                ->joinSub(function ($subquery) use ($student_id) {
                    $subquery->select('M.course_id')
                        ->selectRaw('SUM(1) AS question_nums')
                        ->selectRaw('SUM(M.is_passed) AS passed_question_nums')
                        ->selectRaw('IF(SUM(M.is_passed) / SUM(1) * 100 > M.pass_percent, 1, 0) AS is_completed')
                        ->from(function ($subquery) use ($student_id) {
                            $subquery->select('*')
                                ->selectRaw('IF((R.question_type = "multi" OR R.question_type = "boolean") AND R.quiz_option_nums = R.correct_option_nums, 1, IF(R.question_type = "single" AND R.correct_option_nums = 1, 1, 0)) AS is_passed')
                                ->from(function ($subquery) use ($student_id) {
                                    $subquery->select('T.course_id', 'T.pass_percent', 'T.question_id', 'T.question_text', 'T.question_type', 'T.points')
                                        ->selectRaw('SUM(1) AS quiz_option_nums')
                                        ->selectRaw('SUM(exam_result) AS correct_option_nums')
                                        ->from(function ($subquery) use ($student_id) {
                                            $subquery->select('C.id AS course_id', 'C.pass_percent', 'Q.id AS question_id', 'Q.name AS question_text', 'Q.type AS question_type', 'Q.points', 'QO.description', 'QO.answer', 'SQ.question_id AS student_question_id')
                                                ->selectRaw('SQ.answer AS student_answer')
                                                ->selectRaw('IF(Q.id = SQ.question_id AND (Q.type = "multi" OR Q.type = "boolean") AND QO.answer = SQ.answer, 1, IF(Q.id = SQ.question_id AND Q.type = "single", QO.answer * SQ.answer, 0)) AS exam_result')
                                                ->from('courses AS C')
                                                ->join('student_courses AS SC', function($join) use ($student_id) {
                                                    $join->on('C.id', '=', 'SC.course_id')
                                                        ->where('SC.student_id', $student_id);
                                                })
                                                ->leftJoin('questions AS Q', function ($join) {
                                                    $join->on('C.id', '=', 'Q.course_id');
                                                })
                                                ->leftJoin('question_options AS QO', 'Q.id', '=', 'QO.question_id')
                                                ->leftJoin('student_questions AS SQ', function ($join) use ($student_id) {
                                                    $join->on('C.id', '=', 'SQ.course_id')
                                                        ->on('Q.id', '=', 'SQ.question_id')
                                                        ->on('QO.id', '=', 'SQ.question_option_id')
                                                        ->where('SQ.student_id', $student_id);
                                                });
                                        }, 'T')
                                        ->groupBy('T.course_id', 'T.pass_percent', 'T.question_id', 'T.question_text', 'T.question_type', 'T.points');
                                }, 'R');
                        }, 'M')
                        ->groupBy('M.course_id', 'M.pass_percent');
                }, 'P', function ($join) {
                    $join->on('C.id', '=', 'P.course_id');
                })
                ->where('P.is_completed', 0)
                ->with('lessons')
                ->with('questions')
                ->with('assignedTeacher')
                ->get();
        }
        else {
            $student_id = auth()->user()->id;
            $courses =  Course::select('C.*')
                ->from('courses AS C')
                ->joinSub(function ($subquery) use ($student_id) {
                    $subquery->select('M.course_id')
                        ->selectRaw('SUM(1) AS question_nums')
                        ->selectRaw('SUM(M.is_passed) AS passed_question_nums')
                        ->selectRaw('IF(SUM(M.is_passed) / SUM(1) * 100 > M.pass_percent, 1, 0) AS is_completed')
                        ->from(function ($subquery) use ($student_id) {
                            $subquery->select('*')
                                ->selectRaw('IF((R.question_type = "multi" OR R.question_type = "boolean") AND R.quiz_option_nums = R.correct_option_nums, 1, IF(R.question_type = "single" AND R.correct_option_nums = 1, 1, 0)) AS is_passed')
                                ->from(function ($subquery) use ($student_id) {
                                    $subquery->select('T.course_id', 'T.pass_percent', 'T.question_id', 'T.question_text', 'T.question_type', 'T.points')
                                        ->selectRaw('SUM(1) AS quiz_option_nums')
                                        ->selectRaw('SUM(exam_result) AS correct_option_nums')
                                        ->from(function ($subquery) use ($student_id) {
                                            $subquery->select('C.id AS course_id', 'C.pass_percent', 'Q.id AS question_id', 'Q.name AS question_text', 'Q.type AS question_type', 'Q.points', 'QO.description', 'QO.answer', 'SQ.question_id AS student_question_id')
                                                ->selectRaw('SQ.answer AS student_answer')
                                                ->selectRaw('IF(Q.id = SQ.question_id AND (Q.type = "multi" OR Q.type = "boolean") AND QO.answer = SQ.answer, 1, IF(Q.id = SQ.question_id AND Q.type = "single", QO.answer * SQ.answer, 0)) AS exam_result')
                                                ->from('courses AS C')
                                                ->join('student_courses AS SC', function($join) use ($student_id) {
                                                    $join->on('C.id', '=', 'SC.course_id')
                                                        ->where('SC.student_id', $student_id);
                                                })
                                                ->leftJoin('questions AS Q', function ($join) {
                                                    $join->on('C.id', '=', 'Q.course_id');
                                                })
                                                ->leftJoin('question_options AS QO', 'Q.id', '=', 'QO.question_id')
                                                ->leftJoin('student_questions AS SQ', function ($join) use ($student_id) {
                                                    $join->on('C.id', '=', 'SQ.course_id')
                                                        ->on('Q.id', '=', 'SQ.question_id')
                                                        ->on('QO.id', '=', 'SQ.question_option_id')
                                                        ->where('SQ.student_id', $student_id);
                                                });
                                        }, 'T')
                                        ->groupBy('T.course_id', 'T.pass_percent', 'T.question_id', 'T.question_text', 'T.question_type', 'T.points');
                                }, 'R');
                        }, 'M')
                        ->groupBy('M.course_id', 'M.pass_percent');
                }, 'P', function ($join) {
                    $join->on('C.id', '=', 'P.course_id');
                })
                ->where('P.is_completed', 1)
                ->with('lessons')
                ->with('questions')
                ->with('assignedTeacher')
                ->get();
        }

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

    public function completeLesson($course_id, $lesson_id): void
    {
        $student = auth()->user();
        $is_completed = $student->student_lessons()->where('course_id', $course_id)->where('lesson_id', $lesson_id)->exists();
        if ( !$is_completed) {
            $student->student_lessons()->create([
                'course_id' => $course_id,
                'lesson_id' => $lesson_id
            ]);
        }

    }

    public function completeQuestion($course_id, $question_id, $quiz_options, $is_latest_question): bool
    {
        $student = auth()->user();
        $student->student_questions()->where('course_id', $course_id)->where('question_id', $question_id)->delete();
        foreach($quiz_options as $quiz_option) {
            $student->student_questions()->create([
                'course_id' => $course_id,
                'question_id' => $question_id,
                'question_option_id' => $quiz_option['id'],
                'answer' => $quiz_option['value'],
            ]);
        }

        if ($is_latest_question)
            return $this->isPassedFromCourseExam(Course::find($course_id));
        return true;
    }

    public function isPassedFromCourseExam(Course $course): bool
    {
        $student_id = auth()->user()->id;
        $course_id = $course->id;

        $total_points = 0;
        $correct_points = 0;

        $query = "
                SELECT id, points, SUM(1) quiz_option_nums, SUM(result) correct_option_nums FROM (
                    SELECT C.title, Q.id, Q.name, Q.points, QO.description, QO.answer, SQ.question_id, SQ.answer student_answer,
                        IF(Q.id = SQ.question_id AND QO.answer = SQ.answer, 1, 0) result
                    FROM courses C
                    INNER JOIN student_courses SC ON C.id = SC.course_id AND SC.student_id = '$student_id'
                    LEFT JOIN questions Q ON C.id = Q.course_id
                    LEFT JOIN question_options QO ON Q.id = QO.question_id
                    LEFT JOIN student_questions SQ ON C.id = SQ.course_id AND Q.id = SQ.question_id AND QO.id = SQ.question_option_id AND SQ.student_id = '$student_id'
                    WHERE C.id = '$course_id'
                ) T GROUP BY T.id";
        $questions = DB::select($query);
        foreach($questions as $question) {
            $total_points += $question->points;
            $correct_points += $question->quiz_option_nums == $question->correct_option_nums ? $question->points : 0;
        }
        $student_exam_percent = $total_points == 0 ? 100 : intval($correct_points / $total_points * 100);
        return $student_exam_percent >= $course->pass_percent;
    }

    public function clearQuestion($course_id): void
    {
        $student = auth()->user();
        $student->student_questions()->where('course_id', $course_id)->delete();
    }

    public function isLessonCompleted($lesson_id): bool
    {
        $student = auth()->user();
        $is_completed = $student->student_lessons->where('lesson_id', $lesson_id);
        return (bool)count($is_completed);
    }

    public function isAllLessonCompleted(Course $course): bool
    {
        $student = auth()->user();
        $course_lesson_nums = $course->lessons->count();
        $student_lesson_nums = $student->student_lessons->count();
        return $course_lesson_nums == $student_lesson_nums;
    }

    public function isQuestionCompleted($question_id): bool
    {
        $student = auth()->user();
        $is_completed = $student->student_questions->where('question_id', $question_id);
        return (bool)count($is_completed);
    }

    public function getCourseProgressPercent(Course $course): int
    {
        $total_lessons = count($course->lessons);
        $student = auth()->user();
        $completed_lessons = count($student->student_lessons->where('course_id', $course->id));
        return $total_lessons == 0 ? 0 : intval($completed_lessons / $total_lessons * 100);
    }

    /**
     * Get a course by Id.
     *
     *
     * @return \App\Models\Course
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
    public function createCourse($data): Course
    {
        $course = Course::create([
            'title' => $data['course_title'],
            'price'  => $data['course_price'],
            'pass_percent'  => $data['course_pass_percent'],
            'description'  => $data['course_description'],
            'industry_id'  => $data['industry_id'],
            'image'  => $data['course_image'],
            'created_by'  => auth()->user()->id,
            'assigned_id'  => $data['assigned_id'],
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

        return $course;
    }

    public function updateCourse($data): void
    {
        // update a selected course
        $course = $data['course'];
        $course->fill([
            'title' => $data['course_title'],
            'price'  => $data['course_price'],
            'pass_percent'  => $data['course_pass_percent'],
            'description'  => $data['course_description'],
            'industry_id'  => $data['industry_id'],
            'assigned_id'  => $data['assigned_id'],
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

        // if some quizzes removed from UI, remove the quizzes from database
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

            $answer_ids = explode('$$$', $quiz_info['answer_id']);
            $answers = explode('$$$', $quiz_info['answer']);
            $answer_values = explode('$$$', $quiz_info['answer_values']);
            $question->quiz_options()->whereNotIn('id', $answer_ids)->delete();

            foreach($answers as $key => $answer) {
                if ($answer_ids[$key] == 0) {
                    $question->quiz_options()->create([
                        'description' => $answer,
                        'answer' => $answer_values[$key]
                    ]);
                }
                else {
                    $quiz_option = QuestionOption::find($answer_ids[$key]);
                    $quiz_option->fill([
                        'description' => $answer,
                        'answer' => $answer_values[$key]
                    ]);
                    $quiz_option->save();
                }

            }
        }

    }

    public function setPaidFlag(int $course_id): void
    {
        $course = Course::find($course_id);
        $course->is_paid = true;
        $course->save();
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

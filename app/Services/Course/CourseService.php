<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\Topic;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Eloquent\Collection;

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
            $course = Course::with('lessons')->where('is_published', 1)->get();
        else
            $course = Course::with('lessons')->where('is_published', 0)->get();
        return $course;
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
        $course = Course::createCourse([
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
            $topic = $course->createTopic([
                'description' => $topic_info['title'],
                'user_id' => auth()->user()->id
            ]);

            foreach($topic_info['lessons'] as $lesson_info) {
                $topic->createLesson([
                    'title' => $lesson_info['title'],
                    'description' => $lesson_info['description'],
                    'video_type' => $lesson_info['video_source'],
                    'video_link' => $lesson_info['video_url'],
                    'user_id' => auth()->user()->id,
                    'course_id' => $course->id,
                ]);
            }
        }

        foreach ($data['quiz_list'] as $quiz_info) {
            $question = $course->createQuestion([
                'name' => $quiz_info['title'],
                'description' => $quiz_info['description'],
                'user_id' => auth()->user()->id,
                'type' => $quiz_info['type'],
                'points' => $quiz_info['points']
            ]);

            $answers = explode('$$$', $quiz_info['answer']);
            $answer_values = explode('$$$', $quiz_info['answer_values']);
            foreach($answers as $key => $answer) {
                $question->createQuestionOption([
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
        $course = $course->updateCourse([
            'title' => $data['course_title'],
            'price'  => $data['course_price'],
            'description'  => $data['course_description'],
            'industry_id'  => $data['industry_id'],
            'image'  => $data['course_image'],
            'quiz_active'  => $data['quiz_active'],
            'is_published'  => $data['is_published'],
        ]);


        // if some topics removed from UI, remove the topics from database
        $topic_ids = [];
        foreach($data['topic_list'] as $topic_info) {
            $topic_ids[] = $topic_info['id'];
        }
        $course->topics()->whereNotIn('id', $topic_ids)->delete();

        // Create/Update topics/lessons
        foreach($data['topic_list'] as $topic_info) {
            if ($topic_info['id'] == 0) {
                $topic = $course->createTopic([
                    'description' => $topic_info['title'],
                    'user_id' => auth()->user()->id
                ]);
            }
            else {
                $topic = Topic::find($topic_info['id']);
                $topic = $topic->updateTopic(['description' => $topic_info['title']]);
            }

            // if some lessons removed from UI, remove the lessons from database
            $lesson_ids = [];
            foreach($topic_info['lessons'] as $lesson_info) {
                $lesson_ids[] = $lesson_info['id'];
            }
            $topic->lessons()->whereNotIn('id', $lesson_ids)->delete();

            foreach($topic_info['lessons'] as $lesson_info) {
                if ($lesson_info['id'] == 0) {
                    $topic->createLesson([
                        'title' => $lesson_info['title'],
                        'description' => $lesson_info['description'],
                        'video_type' => $lesson_info['video_source'],
                        'video_link' => $lesson_info['video_url'],
                        'user_id' => auth()->user()->id,
                        'course_id' => $course->id,
                    ]);
                }
                else {
                    $lesson = Lesson::find($lesson_info['id']);
                    $lesson->updateLesson([
                        'title' => $lesson_info['title'],
                        'description' => $lesson_info['description'],
                        'video_type' => $lesson_info['video_source'],
                        'video_link' => $lesson_info['video_url'],
                    ]);
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
                $question = $course->createQuestion([
                    'name' => $quiz_info['title'],
                    'description' => $quiz_info['description'],
                    'user_id' => auth()->user()->id,
                    'type' => $quiz_info['type'],
                    'points' => $quiz_info['points']
                ]);
            }
            else {
                $question = Question::find($quiz_info['id']);
                $question = $question->updateQuestion([
                    'name' => $quiz_info['title'],
                    'description' => $quiz_info['description'],
                    'type' => $quiz_info['type'],
                    'points' => $quiz_info['points']
                ]);
            }

            $question->quiz_options()->delete();

            $answers = explode('$$$', $quiz_info['answer']);
            $answer_values = explode('$$$', $quiz_info['answer_values']);
            foreach($answers as $key => $answer) {
                $question->createQuestionOption([
                    'description' => $answer,
                    'answer' => $answer_values[$key]
                ]);
            }
        }

    }

    public function deleteCourseImage($image_path): void
    {
        $image_name = basename($image_path);
        var_dump('kkkkkk');
        var_dump($image_name);
        var_dump(public_path('upload/course/') . $image_name);
        if ($image_name != 'course.jpg')
            unlink(public_path('upload/course/') . $image_name);
    }
}

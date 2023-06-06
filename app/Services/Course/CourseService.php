<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\Topic;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\QuestionOption;

class CourseService
{
    /**
     * Get published courses.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPublishedCourses()
    {
        return Course::where('is_published', 1)->get();
    }

    /**
     * Get drafted courses.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDraftedCourses()
    {
        return Course::where('is_published', 0)->get();
    }

    /**
     * Get a course by Id.
     *
     *
     * @return \App\Models\Subject
     */
    public function getCourseId(int $id)
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
            $topic = Topic::create([
                'description' => $topic_info['title'],
                'course_id' => $course->id,
                'user_id' => auth()->user()->id
            ]);

            foreach($topic_info['lessons'] as $lesson_info) {
                Lesson::create([
                    'title' => $lesson_info['title'],
                    'description' => $lesson_info['description'],
                    'video_type' => $lesson_info['video_source'],
                    'video_link' => $lesson_info['video_url'],
                    'user_id' => auth()->user()->id,
                    'course_id' => $course->id,
                    'topic_id' => $topic->id
                ]);
            }
        }

        foreach ($data['quiz_list'] as $quiz_info) {
            $question = Question::create([
                'name' => $quiz_info['title'],
                'description' => $quiz_info['description'],
                'user_id' => auth()->user()->id,
                'course_id' => $course->id,
                'type' => $quiz_info['type'],
                'points' => $quiz_info['points']
            ]);

            $answers = explode('$$$', $quiz_info['answer']);
            $answer_values = explode('$$$', $quiz_info['answer_values']);
            foreach($answers as $key => $answer) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'description' => $answer,
                    'answer' => $answer_values[$key]
                ]);
            }
        }
    }

}

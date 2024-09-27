<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\Lesson;
use App\Services\EmailService;
use Illuminate\Http\RedirectResponse;
use App\Services\Course\CourseService;
use App\Models\Course;
use App\Http\Requests\TeacherCourseStoreRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;
use App\Mail\SendinblueMail;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Support\Facades\Validator;

class TeacherCourseController extends Controller
{
    public CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
        $this->authorizeResource(Course::class);
    }

    public function index(): View
    {
        return view('pages.teacher-course.index');
    }

    public function create()
    {
        if (auth()->user()->hasRole('teacher') && ! auth()->user()->payment_connection) {
            return redirect()->route('pricing.index', 'type=payment_method')->with('info', __('To create a course, it is essential to connect to your PayPal account. This ensures that you receive your monthly payments in a prompt and efficient manner'));
        }

        $data['course'] = new Course();
        $data['topics'] = new Collection();
        $data['quizzes'] = new Collection();

        return view('pages.teacher-course.new', $data);
    }

    public function edit(Course $course): View
    {
        $this->middleware(function($request, $next) {
            if (auth()->user()->hasRole('student')) {
                return view('profile.show');
            }

            return $next($request);
        });
        $data['course'] = $course;
        $data['topics'] = $course->topics()->with('lessons')->get();
        $data['quizzes'] = $course->questions()->with('quiz_options')->get();

        return view('pages.teacher-course.edit', $data);
    }

    public function store(TeacherCourseStoreRequest $request): RedirectResponse
    {
        $this->middleware(function($request, $next) {
            if (auth()->user()->hasRole('student')) {
                return redirect()->route('home');
            }

            return $next($request);
        });
        $validator = Validator::make($request->all(), [
            'course_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB limit (adjust as needed)
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return back()->with('notify', __('You have exceeded  the max file size of (2mb)'));
        }

        $data = $this->getCourseData($request);
        if ($data == []) {
            return back()->with('notify', __('You need at least one topic and lesson.'));
        }

        if ( !array_key_exists('course_image', $data))
            $data['course_image'] = asset('images/logo/course.jpg');

        $course = $this->courseService->createCourse($data);
        return redirect()->route('teacher.course.index', 'type=draft');
    }

    public function update(TeacherCourseStoreRequest $request, Course $course): RedirectResponse
    {
        $this->middleware(function($request, $next) {
            if (auth()->user()->hasRole('student')) {
                return redirect()->route('home');
            }

            return $next($request);
        });
        $validator = Validator::make($request->all(), [
            'course_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB limit (adjust as needed)
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return back()->with('notify', __('You have exceeded  the max file size of (2mb)'));
        }

        $data = $this->getCourseData($request);
        if ($data == []) {
            return back()->with('notify', __('You need at least one topic and lesson.'));
        }

        if ($request->hasFile('course_image') || $request['use_default_image'] == 1) {
            // delete course's previous image
            $this->courseService->deleteCourseImage($course->image);
        }

        $data['course'] = $course;
        if ( !array_key_exists('course_image', $data))
            $data['course_image'] = $course->image;

        $this->courseService->updateCourse($data);

        return redirect()->route('teacher.course.index', $data['is_published'] == 1 ? 'type=publish' : 'type=draft');
    }

    public function destroy(Request $request, Course $course): RedirectResponse
    {
        $this->middleware(function($request, $next) {
            if (auth()->user()->hasRole('student')) {
                return redirect()->route('home');
            }

            return $next($request);
        });
        $course->delete();
        return redirect()->route('teacher.course.index', $request['is_published'] == 1 ? 'type=publish' : 'type=draft');
    }

    /**
     * Update course with wp_braintree
     */
    private function updateCourseWithWP($isPubished, Course $course)
    {
        $this->middleware(function($request, $next) {
            if (auth()->user()->hasRole('student')) {
                return redirect()->route('home');
            }

            return $next($request);
        });
        $client = new Client();
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
                    'post_status' => $isPubished ? 'publish' : 'draft',
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

    public function publish(Request $request, Course $course)
    {
        $this->middleware(function($request, $next) {
            if (auth()->user()->hasRole('student')) {
                return redirect()->route('home');
            }

            return $next($request);
        });
        $publish_result = $request['is_published'];
        $email_data = [
            'to' => $course->assignedTeacher->email,
            'subject' => $publish_result == 1 ? __('Your course published') : __('Your course unpublished'),
            'user_name' => $course->assignedTeacher->name,
            'email_type' => 'course_publish',
            'course_name' => $course->title,
            'publish_result' => $publish_result
        ];

        $this->updateCourseWithWP($publish_result, $course);
        $email_service = new EmailService($email_data);
        $result = $email_service->sendEmail();
        if ($result == 'success') {
            $course->is_published = $publish_result;
            $course->save();

            return redirect()->route('teacher.course.index', $publish_result == 1 ? 'type=publish' : 'type=draft');
        }
        else
            return back()->with('notify', __('Email sending failed: ') . $result);
    }

    public function decline(Request $request, Course $course): RedirectResponse
    {
        $this->middleware(function($request, $next) {
            if (auth()->user()->hasRole('student')) {
                return redirect()->route('home');
            }

            return $next($request);
        });
        $email_data = [
            'to' => $course->assignedTeacher->email,
            'subject' => __('Your course declined'),
            'user_name' => $course->assignedTeacher->name,
            'email_type' => 'course_decline',
            'course_name' => $course->title,
            'decline_reason' => $request['decline_reason']
        ];

        $email_service = new EmailService($email_data);
        $result = $email_service->sendEmail();
        if ($result == 'success') {
            $course->is_declined = 1;
            $course->save();
            return redirect()->route('teacher.course.index', 'type=draft');
        }
        else {
            return back()->with('notify', __('Email sending failed: ') . $result);
        }
    }

    public function getCourseIndexByWPIndex(Request $request, int $wp_id): JsonResponse
    {
        $course_id = $wp_id ? $this->courseService->getCourseIndex($wp_id) : 0;

        return response()->json(['id' => $course_id,], ResponseAlias::HTTP_OK);
    }

    public function getCourseContent(Request $request, int $wp_id): JsonResponse
    {
        $topcis = $wp_id ? $this->courseService->getCourseContent($wp_id) : [];

        return response()->json(['topics' => $topcis,], ResponseAlias::HTTP_OK);
    }

    private function getCourseData(TeacherCourseStoreRequest $request): array
    {
        $data['course_title'] = $request['course_title'];
        $data['industry_id'] = $request['industry'];
        $data['assigned_id'] = auth()->user()->id;
        $data['course_price'] = $request['course_price'];      
        $data['course_pass_percent'] = $request['course_pass_percent'];
        $data['course_description'] = $request['course_description'];

        $data['topic_list'] = json_decode($request['topic_list'], true);
        $data['quiz_list'] = json_decode($request['quiz_list'], true);
        $data['quiz_active'] = isset($request['quiz_active']) ? 1 : 0;
        $data['is_published'] = $request['is_published'];

        $lesson_nums = 0;

        foreach ($data['topic_list'] as $topicId => $topic) {
            $lesson_nums += count($topic['lessons']);
            $lessonId = 0;

            foreach ($topic['lessons'] as $lesson) {
                if ($request->has('lessonAttachments')) {
                    $lessonAttachments = json_decode($request->input('lessonAttachments'), true);
                    // Explode file names into an array (no extra spaces)
                    // Check if $lessonAttachments is set and if it contains the key
                    if (isset($lessonAttachments[$lesson['title']])) {
                        // Explode the string if it exists
                        $fileNamesArray = explode(', ', $lessonAttachments[$lesson['title']]);
                    } else {
                        // Handle the case where the key does not exist
                        $fileNamesArray = []; // or whatever default value makes sense
                    }
                    // Initialize tempFilePath
                    $tempFilePath = '';
                    // Check if files are uploaded
                    if ($request->hasFile('multiFiles')) {
                        foreach ($request->file('multiFiles') as $file) {
                            // Loop through exploded file names array
                            foreach ($fileNamesArray as $fileName) {
                                if (trim($fileName) == $file->getClientOriginalName()) {
                                    // Save the uploaded file with a unique name
                                    $saved_file_name = time() . '_' . $file->getClientOriginalName();
                    
                                    try {
                                        // Attempt to move the file
                                        $file->move(public_path('upload/course/attachment'), $saved_file_name);
                                    } catch (\Exception $e) {
                                        // Catch any exception that occurs during the file move operation
                                        \Log::error('File upload failed: ' . $e->getMessage());
                                    }
                    
                                    // Construct the new file path
                                    $newFilePath = asset('upload/course/attachment/' . $saved_file_name);
                    
                                    // Append or set the new file path
                                    if (!empty($tempFilePath)) {
                                        $tempFilePath .= ",  " . $newFilePath;
                                    } else {
                                        $tempFilePath = $newFilePath;
                                    }
                                }
                            }
                        }
                    }
                    // Update the lesson's attachment_file after processing all files
                    $data['topic_list'][$topicId]['lessons'][$lessonId]['attachment_file'] = $tempFilePath;
                }
                
                $lessonId++; // Move to next lesson in the topic
            }
        }

        // Return an empty array if no lessons are found
        if ($lesson_nums == 0) {
            return [];
        }


        if ($request->hasFile('course_image')) {
            $image = $request->file('course_image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('upload/course'), $image_name);
            $data['course_image'] = asset('upload/course/' . $image_name);
        }
        else {
            if ($request['use_default_image'] == 1)
                $data['course_image'] = asset('images/logo/course.jpg');
        }
        return $data;
    }

}

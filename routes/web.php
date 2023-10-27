<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Edit: haha we built something great
| Should I add easter eggs?
|
*/

Route::get('/', function () {
    return redirect()->route('profile.show');
})->name('home');

Route::get('/home', function () {
    return redirect()->route('profile.show');
});

//Payment routes
Route::get('/paypal/connect', ['App\Http\Controllers\PaymentController', 'connect'])->name('paypal.connect');
Route::get('/paypal/connect-success', ['App\Http\Controllers\PaymentController', 'connectSuccess'])->name('paypal.connect_success');
Route::get('/paypal/connect/callback', ['App\Http\Controllers\PaymentController', 'connectCallback'])->name('paypal.callback');
Route::get('/paypal/connect-cancel', ['App\Http\Controllers\PaymentController', 'connectCancel'])->name('paypal.cancel');
Route::post('/paypal/create-order', ['App\Http\Controllers\PaymentController', 'createOrder'])->name('paypal.create_order');
Route::post('/paypal/approve-order', ['App\Http\Controllers\PaymentController', 'approveOrder'])->name('paypal.approve_order');
Route::get('/paypal/complete-order', ['App\Http\Controllers\PaymentController', 'completeOrder'])->name('paypal.complete_order');

Route::post('/verification_resend', ['App\Http\Controllers\RegistrationController', 'verification_resend'])->name('verification.resend');
Route::post('/password_reset', ['App\Http\Controllers\RegistrationController', 'password_reset'])->name('password.reset.email');
Route::post('/password_update', ['App\Http\Controllers\RegistrationController', 'password_update'])->name('password.change');
Route::get('/refresh_csrf_token', ['App\Http\Controllers\RegistrationController', 'refresh_csrf_token'])->name('refresh.token');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', ['App\Http\Controllers\RegistrationController', 'registerView'])->name('register');
    Route::post('/register', ['App\Http\Controllers\RegistrationController', 'register']);
});

//user must be authenticated
Route::middleware('auth:sanctum', 'verified', 'App\Http\Middleware\PreventLockAccountAccess', 'App\Http\Middleware\EnsureDefaultPasswordIsChanged')->namespace('App\Http\Controllers')->group(function () {
    //Setting routes
    Route::get('settings', ['App\Http\Controllers\SettingController', 'index'])->name('settings.index');

    //Pricing routes
    Route::get('pricing', ['App\Http\Controllers\PricingController', 'index'])->name('pricing.index');

    Route::put('teacher_course_publish/{course}', ['App\Http\Controllers\TeacherCourseController', 'publish'])->name('teacher.course.publish');
    Route::post('teacher_course_decline/{course}', ['App\Http\Controllers\TeacherCourseController', 'decline'])->name('teacher.course.decline');

    Route::post('lesson_complete', ['App\Http\Controllers\StudentCourseController', 'lesson_complete'])->name('student.lesson.complete');
    Route::post('review_approve', ['App\Http\Controllers\StudentCourseController', 'review_approve'])->name('student.review.approve');
    Route::post('review_trash', ['App\Http\Controllers\StudentCourseController', 'review_trash'])->name('student.review.trash');
    Route::post('question_complete', ['App\Http\Controllers\StudentCourseController', 'question_complete'])->name('student.question.complete');
    Route::post('question_clear', ['App\Http\Controllers\StudentCourseController', 'question_clear'])->name('student.question.clear');
    Route::post('feedback_register', ['App\Http\Controllers\StudentCourseController', 'feedback_register'])->name('student.feedback.register');
    Route::get('reviews', ['App\Http\Controllers\StudentCourseController', 'reviews'])->name('student.course.reviews');
    Route::get('student/course/{course}/buy', ['App\Http\Controllers\StudentCourseController', 'buy'])->name('student.course.buy');

    Route::post('update_avatar', ['App\Http\Controllers\ProfileController', 'update_avatar'])->name('user.avatar.update');
    Route::post('remove_avatar', ['App\Http\Controllers\ProfileController', 'remove_avatar'])->name('user.avatar.remove');
    Route::post('update_profile', ['App\Http\Controllers\ProfileController', 'update_profile'])->name('user.profile.update');

    //Teacher Courses routes
    Route::prefix('teacher')->group(function () {
        Route::resource('course', TeacherCourseController::class)->names([
            'index' => 'teacher.course.index',
            'create' => 'teacher.course.create',
            'store' => 'teacher.course.store',
            'show' => 'teacher.course.show',
            'edit' => 'teacher.course.edit',
            'update' => 'teacher.course.update',
            'destroy' => 'teacher.course.destroy',
        ]);
    });

    //student routes
    Route::resource('students', StudentController::class);

    //teacher routes
    Route::resource('teachers', TeacherController::class)->only(['index', 'show']);

    // industry routes
    Route::resource('industry', IndustryController::class);

    // certificaiton routes
    Route::get('certification', ['App\Http\Controllers\CertificationController', 'index'])->name('certification.index');
    Route::get('download_certification', ['App\Http\Controllers\CertificationController', 'download'])->name('certification.download');

    //Marks routes
    Route::get('marks', ['App\Http\Controllers\MarksController', 'index'])->name('marks.index');

    //Students Courses routes
    Route::prefix('student')->group(function () {
        Route::resource('course', StudentCourseController::class)->names([
            'index' => 'student.course.index',
            'show' => 'student.course.show',
        ]);
    });

    //lock account route
    Route::post('users/lock-account/{user}', 'App\Http\Controllers\LockUserAccountController')->name('user.lock-account');
    Route::delete('user/{user}', ['App\Http\Controllers\RegistrationController', 'destroy'])->name('user.destroy');
});

//user must be authenticated
Route::middleware('auth:sanctum', 'verified', 'App\Http\Middleware\PreventLockAccountAccess', 'App\Http\Middleware\EnsureDefaultPasswordIsChanged')->prefix('dashboard')->namespace('App\Http\Controllers')->group(function () {
    //dashboard route
    Route::get('/', function () {
        return view('profile.show');
    })->name('profile.show');

    Route::get('account-applications/rejected-applications', ['App\Http\Controllers\AccountApplicationController', 'rejectedApplicationsView'])->name('account-applications.rejected-applications');

    //account application routes. We need the applicant instead of the record
    Route::resource('account-applications', AccountApplicationController::class)->parameters([
        'account-applications' => 'applicant',
    ]);

    Route::get('account-applications/change-status/{applicant}', ['App\Http\Controllers\AccountApplicationController', 'changeStatusView'])->name('account-applications.change-status');

    Route::post('account-applications/change-status/{applicant}', ['App\Http\Controllers\AccountApplicationController', 'changeStatus']);

});

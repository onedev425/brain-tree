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
    return redirect()->route('dashboard');
})->name('home');

Route::get('/home', function () {
    return redirect()->route('dashboard');
});

//Paypal routes
Route::get('/paypal/connect-success', ['App\Http\Controllers\PricingController', 'connectPaypalSuccess'])->name('paypal.callback');
Route::get('/paypal/connect-cancel', ['App\Http\Controllers\PricingController', 'connectPaypalCancel'])->name('paypal.cancel');

Route::middleware(['guest'])->group(function () {
    Route::get('/register', ['App\Http\Controllers\RegistrationController', 'registerView'])->name('register');
    Route::post('/register', ['App\Http\Controllers\RegistrationController', 'register']);
});

//user must be authenticated
Route::middleware('auth:sanctum', 'verified', 'App\Http\Middleware\PreventLockAccountAccess', 'App\Http\Middleware\EnsureDefaultPasswordIsChanged')->prefix('dashboard')->namespace('App\Http\Controllers')->group(function () {
    //dashboard route
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('account-applications/rejected-applications', ['App\Http\Controllers\AccountApplicationController', 'rejectedApplicationsView'])->name('account-applications.rejected-applications');

    //account application routes. We need the applicant instead of the record
    Route::resource('account-applications', AccountApplicationController::class)->parameters([
        'account-applications' => 'applicant',
    ]);

    Route::get('account-applications/change-status/{applicant}', ['App\Http\Controllers\AccountApplicationController', 'changeStatusView'])->name('account-applications.change-status');

    Route::post('account-applications/change-status/{applicant}', ['App\Http\Controllers\AccountApplicationController', 'changeStatus']);

    //graduation routes
    Route::get('students/graduations', ['App\Http\Controllers\GraduationController', 'index'])->name('students.graduations');
    Route::get('students/graduate', ['App\Http\Controllers\GraduationController', 'graduateView'])->name('students.graduate');
    Route::post('students/graduate', ['App\Http\Controllers\GraduationController', 'graduate']);
    Route::delete('students/graduations/{student}/reset', ['App\Http\Controllers\GraduationController', 'resetGraduation'])->name('students.graduations.reset');

    //fee categories routes
    Route::resource('fees/fee-categories', FeeCategoryController::class);

    //fee invoice record routes
    Route::post('fees/fee-invoices/fee-invoice-records/{fee_invoice_record}/pay', ['App\Http\Controllers\FeeInvoiceRecordController', 'pay'])->name('fee-invoices-records.pay');
    Route::resource('fees/fee-invoices/fee-invoice-records', FeeInvoiceRecordController::class);

    //fee incvoice routes
    Route::get('fees/fee-invoices/{fee_invoice}/pay', ['App\Http\Controllers\FeeInvoiceController', 'payView'])->name('fee-invoices.pay');
    Route::get('fees/fee-invoices/{fee_invoice}/print', ['App\Http\Controllers\FeeInvoiceController', 'print'])->name('fee-invoices.print');
    Route::resource('fees/fee-invoices', FeeInvoiceController::class);

    //fee routes
    Route::resource('fees', FeeController::class);

    //set exam status
    Route::post('exams/{exam}/set--active-status', ['App\Http\Controllers\ExamController', 'setExamActiveStatus'])->name('exams.set-active-status');

    // set publish result status
    Route::post('exams/{exam}/set-publish-result-status', ['App\Http\Controllers\ExamController', 'setPublishResultStatus'])->name('exams.set-publish-result-status');

    //exam tabulation sheet
    Route::get('exams/tabulation-sheet', ['App\Http\Controllers\ExamController', 'examTabulation'])->name('exams.tabulation');

    //result checker
    Route::get('exams/result-checker', ['App\Http\Controllers\ExamController', 'resultChecker'])->name('exams.result-checker');

    //exam routes
    Route::resource('exams', ExamController::class);

    //exam slot routes
    Route::scopeBindings()->group(function () {
        Route::resource('exams/{exam}/manage/exam-slots', ExamSlotController::class);
    });

        //Setting routes
    Route::get('settings', ['App\Http\Controllers\SettingController', 'index'])->name('settings.index');

    //Pricing routes
    Route::get('pricing', ['App\Http\Controllers\PricingController', 'index'])->name('pricing.index');

    Route::resource('teacher/course', TeacherCourseController::class);

    //manage exam record
    Route::resource('exams/exam-records', ExamRecordController::class);

        //student routes
    Route::resource('students', StudentController::class);
    Route::get('students/{student}/print', ['App\Http\Controllers\StudentController', 'printProfile'])->name('students.print-profile');

    //admin routes
    Route::resource('admins', AdminController::class);

    //teacher routes
    Route::resource('teachers', TeacherController::class);

    //lock account route
    Route::post('users/lock-account/{user}', 'App\Http\Controllers\LockUserAccountController')->name('user.lock-account');

    //assign teachers to subject in class
    Route::get('subjects/assign-teacher', ['App\Http\Controllers\SubjectController', 'assignTeacherVIew'])->name('subjects.assign-teacher');
    Route::post('subjects/assign-teacher/{teacher}', ['App\Http\Controllers\SubjectController', 'assignTeacher'])->name('subjects.assign-teacher-to-subject');

    //subject routes
    Route::resource('subjects', SubjectController::class);

    //notice routes
    Route::resource('notices', NoticeController::class);
});

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Models\User;
use App\Services\Student\StudentService;
use App\Services\User\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public StudentService $studentService;

    /**
     * Instance of user service class.
     *
     * @var UserService
     */
    public UserService $userService;

    //construct method which assigns studentService to student variable
    public function __construct(StudentService $studentService, UserService $userService)
    {
        $this->studentService = $studentService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('viewAny', [User::class, 'student']);

        return view('pages.student.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(User $student): View|Response
    {
        $this->userService->verifyUserIsOfRoleElseNotFound($student, 'student');
        $this->authorize('view', [$student, 'student']);

        return view('pages.student.show', compact('student'));
    }

    /**
     * Edit the specified resource.
     */
    public function edit(User $student): View|Response
    {
        $this->authorize('view', [$student, 'student']);

        return view('pages.student.edit', compact('student'));
    }

    /**
     * Display the specified resource.
     */
    public function reviews(User $student): View|Response
    {
        $this->userService->verifyUserIsOfRoleElseNotFound($student, 'student');
        $this->authorize('view', [$student, 'student']);

        return view('pages.student.show', compact('student'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $input['name'] = $request['name'];
        $input['phone'] = $request->input('phone');
        Log::info('Created the user successfully'.$request['email']);
        Log::info('Created the user successfully11'.json_encode($user));
        Log::info('Created the user successfully22'.json_encode($request));
        $validation_rules = array(
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        );

        $input['birthday'] = $request['birthday'];
        $validation_rules['birthday'] = ['required', 'string', 'max:20'];
        Validator::make($input, $validation_rules)->validate();

        if ($request['email'] !== $user->email) {
            $input['email'] = $request('email');
        }

        $input['country_id'] = $request['country'];
        $input['language_id'] = $request['language'];
        $input['industry_id'] = $request['industry'];

        $user->forceFill($input)->save();

        return back()->with('success', 'The student profile updated successfully');
    }
}

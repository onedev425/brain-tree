<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Teacher\TeacherService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public TeacherService $teacherService;

    public function __construct(TeacherService $teacherService)
    {
        $this->teacherService = $teacherService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $this->authorize('viewAny', [User::class, 'teacher']);

        return view('pages.teacher.index');
    }

    /**
     * Display the specified resource.
     *
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $teacher): View
    {
        $this->authorize('view', [$teacher, 'teacher']);

        return view('pages.teacher.show', compact('teacher'));
    }

    /**
     * Edit the specified resource.
     */
    public function edit(User $teacher): View
    {
        $this->authorize('view', [$teacher, 'teacher']);
        return view('pages.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher)
    {
        $input['name'] = $request['name'];
        $input['phone'] = $request->input('phone');
        $input['email'] = $request->input('email');

        $validation_rules = array(
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($teacher->id)],
        );

        Validator::make($input, $validation_rules)->validate();

        $input['country_id'] = $request['country'];
        $input['language_id'] = $request['language'];
        $input['industry_id'] = $request['industry'];
        $input['experience'] = $request['experience'];
        $input['skills'] = $request['skills'];
        $input['description'] = $request['description'];
        $teacher->forceFill($input)->save();

        return redirect()->route('teachers.show', $teacher->id)->with('success', 'The instructor profile updated successfully');
    }
}

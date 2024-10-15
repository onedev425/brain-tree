<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Course;
use Illuminate\View\View;
use App\Http\Requests\TeacherAnnouncementStoreRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    // In Announcement.php
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Retrieve all announcements from the database
        $announcements = Announcement::with('course')->get();

        // Check if the collection is not empty
        if ($announcements->isNotEmpty()) {
            // Process the announcements if not empty
            $announcementsArray = $announcements->map(function ($announcement) {
                return [
                    'id' => $announcement->id,
                    'title' => $announcement->title,
                    'start_date' => $announcement->start_date,
                    'end_date' => $announcement->end_date,
                    'content' => $announcement->content,
                    'course_id' => $announcement->course_id,
                    'course_title' => $announcement->course ? $announcement->course->title : 'No Course',
                ];
            });
        } else {
            $announcementsArray = [];
        }

        // Retrieve all courses with only id and title
        $courses = Course::select('id', 'title')->get();

        // Return the view with both announcements and course data
        return view('pages.teacher-announcement.index', [
            'announcements' => $announcementsArray,
            'courses' => $courses,
        ]);

        return view('pages.teacher-announcement.index', ['announcements' => $announcementsArray]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherAnnouncementStoreRequest $request): RedirectResponse
    {
        // Retrieve validated data from the request
        $validated = $request->validated();
        // Create a new announcement instance
        $announcement = new Announcement();
        
        // Assign values from the validated request
        $announcement->course_id = $validated['course_id'];
        $announcement->title = $validated['title'];
        $announcement->start_date = $validated['start_date'];
        $announcement->end_date = $validated['end_date'];
        $announcement->content = $validated['content'];
        // Handle file upload (if provided)
        if ($request->hasFile('attachment_file')) {
            // Get the file object
            $file = $request->file('attachment_file');
            
            // Debugging: Check if file is valid
            if ($file->isValid()) {
                $saved_file_name = time() . '_' . $file->getClientOriginalName();
                try {
                    $file->move(public_path('upload/announcement/attachment'), $saved_file_name);
                    
                    // Assign the absolute URL to the announcement's attachment_file field
                    $announcement->attachment_file = asset('upload/announcement/attachment/' . $saved_file_name);
                } catch (\Exception $e) {
                    // If an error occurs during upload, log the error
                    \Log::error('File upload error: ' . $e->getMessage());
                    return back()->withErrors(['attachment_file' => 'There was an error uploading the file.']);
                }
            } else {
                return back()->withErrors(['attachment_file' => 'Uploaded file is not valid.']);
            }
        } else {
            \Log::info('No file uploaded');
        }


        // Save the announcement
        $announcement->save();

        // Redirect to the announcement index page with success message
        return redirect()->route('teacher.announcement.index')
                        ->with('success', 'Announcement created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'course_id' => 'required|exists:courses,id',
            'attachment_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048'
        ]);

        // Find the announcement
        $announcement = Announcement::findOrFail($id);

        // Update the announcement fields
        $announcement->title = $validated['title'];
        $announcement->content = $validated['content'] ?? null;
        $announcement->start_date = $validated['start_date'];
        $announcement->end_date = $validated['end_date'];
        $announcement->course_id = $validated['course_id'];

        // Handle file upload (if provided)
        if ($request->hasFile('attachment_file')) {
            // Delete the old file if exists
            if ($announcement->attachment_file) {
                Storage::disk('public')->delete($announcement->attachment_file);
            }
            $file = $request->file('attachment_file');
            $saved_file_name = time() . '_' . $file->getClientOriginalName();
            try {
                $file->move(public_path('upload/announcement/attachment'), $saved_file_name);
                // Assign the absolute URL to the announcement's attachment_file field
                $announcement->attachment_file = asset('upload/announcement/attachment/' . $saved_file_name);
            } catch (\Exception $e) {
                // If an error occurs during upload, log the error
                \Log::error('File upload error: ' . $e->getMessage());
                return back()->withErrors(['attachment_file' => 'There was an error uploading the file.']);
            }
        }

        // Save the updated announcement
        $announcement->save();

        // Redirect to the index page with a success message
        return redirect()->route('teacher.announcement.index')->with('success', 'Announcement updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        // Find the announcement by ID
        $announcement = Announcement::findOrFail($id);
        
        // Delete the announcement
        $announcement->delete();

        // Redirect back with a success message
        return redirect()->route('teacher.announcement.index')
                        ->with('success', 'Announcement deleted successfully!');
    }

}

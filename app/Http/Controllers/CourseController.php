<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Course;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::all();
        return view('courses.index')->with('courses', $courses);
    }

    public function create(): View
    {
        return view('courses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')->with('flash_message', 'Course created.');
    }

    public function show(string $id): View
    {
        $course = Course::findOrFail($id);
        return view('courses.show')->with('course', $course);
    }

    public function edit(string $id): View
    {
        $course = Course::findOrFail($id);
        return view('courses.edit')->with('course', $course);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $course = Course::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')->with('flash_message', 'Course updated.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Course::destroy($id);
        return redirect()->route('courses.index')->with('flash_message', 'Course deleted.');
    }
}

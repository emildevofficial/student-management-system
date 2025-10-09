<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index(): View
    {
        $teachers = Teacher::all();
        return view('teachers.index')->with('teachers', $teachers);
    }

    public function create(): View
    {
        return view('teachers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile' => 'nullable|string|max:50',
        ]);

        Teacher::create($validated);
        return redirect()->route('teachers.index')->with('flash_message', 'Teacher Added!');
    }

    public function show(string $id): View
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.show')->with('teachers', $teacher);
    }

    public function edit(string $id): View
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit')->with('teachers', $teacher);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $teacher = Teacher::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'mobile' => 'nullable|string|max:50',
        ]);

        $teacher->update($validated);
        return redirect()->route('teachers.index')->with('flash_message', 'Teacher Updated!');
    }

    public function destroy(string $id): RedirectResponse
    {
        Teacher::destroy($id);
        return redirect()->route('teachers.index')->with('flash_message', 'Teacher Deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\CourseKeypoint;
use App\Models\CourseVideo;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan data user beserta role user yang sedang login
        $user = Auth::user();
        $query = Course::with(['category', 'teacher', 'students'])->orderByDesc('id');

        // Jika role user adalah teacher, hanya menampilkan course dengan id user tersebut
        if ($user->hasRole('teacher')) {
            $query->whereHas('teacher', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        // Membatasi hanya 10 data perhalaman
        $courses = $query->paginate(5);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        $categories = Category::all();
        return view('admin.courses.create', compact('teachers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        DB::transaction(function () use ($request) {

            $teacher = Teacher::where('user_id', Auth::user()->id)->first();

            if (!$teacher) {
                return redirect()->route('admin.courses.index')->withErrors('Unauthorized or invalid teacher');
            }

            $validated = $request->validated();
            $validated['slug'] = Str::slug($validated['name']);
            $validated['teacher_id'] = $teacher->id;

            // Proses upload foto
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $course = Course::create($validated);

            foreach ($validated['course_keypoints'] as $name) {
                $course->courseKeypoint()->create([
                    'name' => $name,
                ]);
            }
        });

        return redirect()->route('admin.courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $courseVideos = CourseVideo::where('course_id', $course->id)
            ->with(['course'])
            ->paginate(5);

        return view('admin.courses.show', compact('course', 'courseVideos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        DB::transaction(function () use ($request, $course) {

            $validated = $request->validated();
            $validated['slug'] = Str::slug($validated['name']);

            // Proses upload foto
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
                $validated['thumbnail'] = $thumbnailPath;
            }

            $course->update($validated);

            $course->courseKeypoint()->delete();
            foreach ($validated['course_keypoints'] as $name) {
                $course->courseKeypoint()->create([
                    'name' => $name,
                ]);
            }
        });

        return redirect()->route('admin.courses.show', compact('course'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        DB::beginTransaction();

        try {
            $course->delete();
            DB::commit();
            return redirect()->route('admin.courses.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.courses.index')->with('error', 'Terjadi kesalahan: ' + $exception);
        }
    }
}

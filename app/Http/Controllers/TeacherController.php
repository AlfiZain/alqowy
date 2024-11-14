<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::orderByDesc('id')->paginate(5);
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $user = User::where('email', $validated['email'])->first();
            if (!$user) {
                return back()->withErrors([
                    'email' => 'Data tidak ditemukan'
                ]);
            }

            if ($user->hasRole('teacher')) {
                return back()->withErrors([
                    'email' => 'Data tersebut sudah menjadi teacher'
                ]);
            }

            $validated['user_id'] = $user->id;
            $validated['is_active'] = true;
            Teacher::create($validated);

            if ($user->hasRole('student')) {
                $user->removeRole('student');
            }

            $user->assignRole('teacher');
        });

        return redirect()->route('admin.teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        DB::beginTransaction();

        try {
            $user = User::find($teacher->user_id);
            $user->removeRole('teacher');
            $user->assignRole('student');

            $teacher->delete();
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $exception->getMessage()]
            ]);
            throw $error;
        }
    }
}

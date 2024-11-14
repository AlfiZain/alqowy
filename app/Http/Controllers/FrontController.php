<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscribeTransactionRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseVideo;
use App\Models\SubscribeTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        $courses = Course::with('category', 'teacher', 'students')->orderByDesc('id')->get();
        return view('front.index', compact('categories', 'courses'));
    }

    public function details(Course $course)
    {
        return view('front.details', compact('course'));
    }

    public function category(Category $category)
    {
        $courses = $category->courses()->get();
        return view('front.category', compact('category', 'courses'));
    }

    public function learning(Course $course, $courseVideoId)
    {
        $user = Auth::user();
        if (!$user->hasActiveSubscription()) {
            return redirect()->route('front.pricing')->with('message', 'Silahkan subscribe terlebih dahulu untuk mendapatkan akses ke kelas-kelas terbaik kami');
        }

        // Mengambil video berdasarkan id dari course_id pada tabel course_videos
        $video = $course->courseVideos->firstWhere('id', $courseVideoId);

        // Menyimpan user tersebut sebagai student yang belajar course tersebut
        // Data student tersebut unik, jika sudah ada maka tidak akan ditambahkan
        $user->courses()->syncWithoutDetaching($course->id);

        // Memperbarui kolom `updated_at` di tabel pivot untuk kursus yang diakses
        $user->courses()->updateExistingPivot($course->id, ['updated_at' => now()]);

        return view('front.details', compact('course', 'video'));
    }

    public function pricing()
    {
        return view('front.pricing');
    }

    public function categories()
    {
        return view('front.category');
    }

    public function checkout()
    {
        $user = Auth::user();
        // if ($user->subscribeTransactions()) {
        //     return redirect()->route('front.pricing')->with('message', 'Anda telah melampirkan bukti pembayaran, silahkan tunggu konfirmasi dari kami');
        // }
        if ($user->hasActiveSubscription()) {
            return redirect()->route('front.pricing')->with('message', 'Akun Anda sudah melakukan subscription');
        } else {
            return view('front.checkout');
        }
    }

    public function checkout_store(StoreSubscribeTransactionRequest $request)
    {
        $user = Auth::user();
        if ($user->hasActiveSubscription()) {
            return redirect()->route('front.index');
        }

        DB::transaction(function () use ($user, $request) {
            $validated = $request->validated();

            if ($request->hasFile('proof')) {
                $filePath = $request->file('proof')->store('proof', 'public');
                $validated['proof'] = $filePath;
            }

            $validated['user_id'] = $user->id;
            $validated['total_amount'] = 39000;
            $validated['is_paid'] = false;

            $transaction = SubscribeTransaction::updateOrCreate(['user_id' => $user->id], $validated);
        });

        return redirect()->route('dashboard')->with('message', 'Bukti pembayaran telah dikirim, silahkan tunggu konfirmasi dari pihak Alqowy. Terima kasih');
    }
}

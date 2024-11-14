<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Courses') }}
            </h2>
            @role('teacher')
                <a href="{{ route('admin.courses.create') }}"
                    class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                    Add New
                </a>
            @endrole
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                {{ $courses->links() }}
                @forelse ($courses as $course)
                    <div
                        class="item-card grid grid-cols-2 md:grid-cols-6 lg:grid-cols-9 gap-y-10 justify-between md:items-center">
                        <div class="flex flex-row items-center gap-x-3 md:col-span-2 lg:col-span-3">
                            <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->name }}"
                                class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $course->name }}</h3>
                                <p class="text-slate-500 text-sm">{{ $course->category->name }}</p>
                            </div>
                        </div>
                        <div class="hidden md:flex flex-col md:mx-auto lg:mx-0">
                            <p class="text-slate-500 text-sm">Students</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $course->students->count() }}</h3>
                        </div>
                        <div class="hidden md:flex flex-col md:mx-auto lg:mx-0">
                            <p class="text-slate-500 text-sm">Videos</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $course->courseVideos->count() }}</h3>
                        </div>
                        <div class="hidden lg:flex flex-col lg:col-span-2">
                            <p class="text-slate-500 text-sm">Teacher</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $course->teacher->user->name }}</h3>
                        </div>
                        <div class="flex flex-col md:flex-row gap-x-3 md:col-span-2 justify-end items-end">
                            <a href="{{ route('admin.courses.show', $course) }}"
                                class="font-bold py-4 w-24 bg-indigo-700 text-white rounded-full text-center mb-2 md:mb-0">
                                Manage
                            </a>
                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="font-bold py-4 w-24 bg-red-700 text-white rounded-full text-center">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-xl font-bold">Belum ada course</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

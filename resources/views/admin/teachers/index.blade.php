<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Teachers') }}
            </h2>
            <a href="{{ route('admin.teachers.create') }}"
                class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>
    <div>

    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                {{ $teachers->links() }}
                @forelse ($teachers as $teacher)
                    <div class="item-card grid grid-cols-2 md:grid-cols-3 justify-between items-center gap-x-2">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($teacher->user->avatar ?? 'images/default-avatar.png') }}"
                                alt="{{ $teacher->user->name }}" class="rounded-2xl object-cover w-[90px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $teacher->user->name }}</h3>
                                <p class="text-slate-500 text-sm">{{ $teacher->user->occupation }}</p>
                            </div>
                        </div>
                        <div class="hidden md:flex flex-col mx-auto">
                            <p class="text-slate-500 text-sm">Date</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $teacher->created_at }}</h3>
                        </div>
                        <div class="flex flex-row justify-end">
                            <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST">
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
                    <p class="text-xl font-bold">Belum ada Guru</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

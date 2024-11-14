<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}"
                class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                {{ $categories->links() }}
                @forelse ($categories as $category)
                    <div class="item-card grid grid-cols-2 md:grid-cols-3 justify-between items-center gap-x-2">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($category->icon) }}" alt="{{ $category->name }}"
                                class="rounded-2xl object-cover w-[90px] h-[90px]">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $category->name }}</h3>
                        </div>
                        <div class="hidden md:flex flex-col mx-auto">
                            <p class="text-slate-500 text-sm">Date</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $category->created_at }}</h3>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-x-3 justify-end items-end">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="font-bold py-4 w-24 bg-indigo-700 text-white rounded-full text-center mb-2 sm:mb-0">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
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
                    <p class="text-xl font-bold">
                        Belum ada kategori
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

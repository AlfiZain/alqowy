<div
    class="flex flex-col rounded-t-[12px] rounded-b-[24px] gap-[32px] bg-white pb-[10px] overflow-hidden transition-all duration-300 ring-1 hover:ring-2 hover:ring-[#FF6129]">
    <a href="{{ route('front.details', $course->slug) }}"
        class="thumbnail w-full h-[200px] shrink-0 rounded-[10px] overflow-hidden">
        <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
    </a>
    <div class="flex flex-col px-4 gap-[10px]">
        <a href="{{ route('front.details', $course->slug) }}"
            class="font-semibold text-lg line-clamp-2 hover:line-clamp-none min-h-[56px]">{{ $course->name }}</a>
        <div class="hidden md:flex justify-between items-center">
            <div class="flex items-center gap-[2px]">
                <div>
                    <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                </div>
                <div>
                    <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                </div>
                <div>
                    <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                </div>
                <div>
                    <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                </div>
                <div>
                    <img src="{{ asset('assets/icon/star.svg') }}" alt="star">
                </div>
            </div>
            <p class="text-right text-[#6D7786]">{{ $course->students->count() }} Students</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 flex shrink-0 rounded-full overflow-hidden">
                <img src="{{ Storage::url($course->teacher->user->avatar) }}" class="w-full h-full object-cover"
                    alt="icon">
            </div>
            <div class="flex flex-col">
                <p class="font-semibold">{{ $course->teacher->user->name }}</p>
                <p class="text-[#6D7786]">{{ $course->teacher->user->occupation }}</p>
            </div>
        </div>
    </div>
</div>

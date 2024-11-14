<x-front>
    <div id="hero-section" style="background-image: url('{{ asset('../assets/background/Hero-Banner.png') }}')"
        class="max-w-[1200px] mx-auto w-full flex flex-col gap-10  bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        @include('components.front.front_navigation')
        <section id="Top-Categories" class="max-w-[1200px] mx-auto flex flex-col gap-[30px] px-4 md:px-14 pb-6">
            <div class="flex flex-col gap-[30px]">
                <div
                    class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                    <div>
                        <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="icon">
                    </div>
                    <p class="font-medium text-sm text-[#FF6129]">Top Categories</p>
                </div>
                <div class="flex flex-col">
                    <h2 class="font-bold text-white text-[40px] leading-[60px]">{{ $category->name }}</h2>
                    <p class="text-slate-300 text-lg -tracking-[2%]">Catching up the on demand skills and high paying
                        career this year</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-[30px] w-full">
                    @forelse ($courses as $course)
                        <div class="course-card">
                            @include('components.front.course-card');
                        </div>
                    @empty
                        <p class="text-xl font-semibold text-white">Belum ada course pada category ini</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
    <section id="Zero-to-Success"
        class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[50px] gap-[30px] bg-[#F5F8FA] rounded-[32px]">
        @include('components.front.testimonials')
    </section>
</x-front>

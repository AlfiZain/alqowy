<x-front>
    <div id="hero-section" style="background-image: url('{{ asset('../assets/background/Hero-Banner.png') }}');"
        class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 pb-[50px] bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        @include('components.front.front_navigation')
        <div class="flex flex-col items-center gap-[30px] px-4">
            <div class="w-fit flex items-center gap-3 p-2 pr-6 rounded-full bg-[#FFFFFF1F] border border-[#3477FF24]">
                <div class="w-[100px] h-[48px] flex shrink-0">
                    <img src="{{ asset('assets/icon/avatar-group.png') }}" class="object-contain" alt="icon">
                </div>
                <p class="font-semibold text-sm text-white">Join 3 million users</p>
            </div>
            <div class="flex flex-col gap-[10px]">
                <h1
                    class="font-semibold text-[80px] leading-[82px] text-center bg-clip-text text-transparent bg-gradient-to-br from-sky-400 to-blue-700">
                    Build
                    Future Career.
                </h1>
                <p class="text-center text-xl leading-[36px] text-[#F5F8FA]">Alqowy provides high quality online courses
                    for you to grow <br>
                    your skills and build outstanding portfolio to tackle job interviews</p>
            </div>
            <div class="flex gap-6 w-fit">
                <a href=""
                    class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980] text-center">Explore
                    Courses</a>
                <a href=""
                    class="text-white font-semibold rounded-[30px] p-[16px_32px] ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129] text-center">Career
                    Guidance</a>
            </div>
        </div>
        <div class="flex flex-wrap items-center justify-around gap-4">
            <div>
                <img src="{{ asset('assets/icon/logo-55.svg') }}" alt="icon">
            </div>
            <div>
                <img src="{{ asset('assets/icon/logo.svg') }}" alt="icon">
            </div>
            <div>
                <img src="{{ asset('assets/icon/logo-54.svg') }}" alt="icon">
            </div>
            <div>
                <img src="{{ asset('assets/icon/logo.svg') }}" alt="icon">
            </div>
            <div>
                <img src="{{ asset('assets/icon/logo-52.svg') }}" alt="icon">
            </div>
        </div>
    </div>
    <section id="Top-Categories" class="max-w-[1200px] mx-auto flex flex-col p-[70px_50px] gap-[30px]">
        <div class="flex flex-col gap-[30px]">
            <div
                class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="icon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Top Categories</p>
            </div>
            <div class="flex flex-col">
                <h2 class="font-bold text-[40px] leading-[60px]">Browse Courses</h2>
                <p class="text-[#6D7786] text-lg -tracking-[2%]">Catching up the on demand skills and high paying career
                    this year</p>
            </div>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-[30px]">
            @forelse($categories as $category)
                <a href="{{ route('front.category', $category->slug) }}"
                    class="card flex items-center p-4 gap-3 ring-1 ring-[#DADEE4] rounded-2xl hover:ring-2 hover:ring-[#FF6129] transition-all duration-300">
                    <div class="flex flex-col">
                        <div class="w-12 h-12 shrink-0">
                            <img src="{{ Storage::url($category->icon) }}" class="object-contain" alt="icon">
                        </div>
                        <p class="font-bold text-sm lg:text-lg">{{ $category->name }}</p>
                    </div>
                </a>
            @empty
                <p>
                    Belum ada kategori tersedia
                </p>
            @endforelse
        </div>
    </section>
    <section id="Popular-Courses"
        class="max-w-[1200px] mx-auto flex flex-col p-[70px_82px_0px] gap-[30px] bg-[#F5F8FA] rounded-[32px]">
        <div class="flex flex-col gap-[30px] items-center text-center">
            <div
                class="gradient-badge w-fit p-[8px_16px] rounded-full border border-[#FED6AD] flex items-center gap-[6px]">
                <div>
                    <img src="{{ asset('assets/icon/medal-star.svg') }}" alt="icon">
                </div>
                <p class="font-medium text-sm text-[#FF6129]">Popular Courses</p>
            </div>
            <div class="flex flex-col">
                <h2 class="font-bold text-[40px] leading-[60px]">Don’t Missed It, Learn Now</h2>
                <p class="text-[#6D7786] text-lg -tracking-[2%]">Catching up the on demand skills and high paying career
                    this year</p>
            </div>
        </div>
        <div class="relative">
            <button class="btn-prev absolute rotate-180 -left-[52px] top-[216px]">
                <img src="{{ asset('assets/icon/arrow-right.svg') }}" alt="icon">
            </button>
            <button class="btn-next absolute -right-[52px] top-[216px]">
                <img src="{{ asset('assets/icon/arrow-right.svg') }}" alt="icon">
            </button>
            <div id="course-slider" class="w-full">
                @forelse($courses as $course)
                    <div class="course-card w-full md:w-1/3 px-3 pb-[70px] mt-[2px]">
                        @include('components.front.course-card')
                    </div>
                @empty
                    <p>
                        Belum ada course terbaru
                    </p>
                @endforelse
            </div>
        </div>
    </section>
    <section id="Pricing" class="max-w-[1200px] mx-auto flex justify-between items-center p-[70px_100px]">
        <div class="hidden lg:flex lg:relative">
            <div class="block w-[355px] h-[488px]">
                <img src="{{ asset('assets/background/benefit_illustration.png') }}" alt="icon">
            </div>
            <div
                class="absolute w-[230px] transform -translate-y-1/2 top-1/2 left-[214px] bg-white z-10 rounded-[20px] gap-4 p-4 flex flex-col shadow-[0_17px_30px_0_#0D051D0A]">
                <p class="font-semibold">Materials</p>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src="{{ asset('assets/icon/video-play.svg') }}" alt="icon">
                    </div>
                    <p class="font-medium">Videos</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src="{{ asset('assets/icon/note-favorite.svg') }}" alt="icon">
                    </div>
                    <p class="font-medium">Handbook</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src="{{ asset('assets/icon/3dcube.svg') }}" alt="icon">
                    </div>
                    <p class="font-medium">assets</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src="{{ asset('assets/icon/award.svg') }}" alt="icon">
                    </div>
                    <p class="font-medium">Certificates</p>
                </div>
                <div class="flex gap-2 items-center">
                    <div>
                        <img src="{{ asset('assets/icon/book.svg') }}" alt="icon">
                    </div>
                    <p class="font-medium">Documentations</p>
                </div>
            </div>
        </div>
        <div class="flex flex-col text-left gap-[30px]">
            <h2 class="font-bold text-[36px] leading-[52px]">Learn From Anywhere,<br>Anytime You Want</h2>
            <p class="text-[#475466] text-lg leading-[34px]">Growing new skills would be more flexible without <br>
                limit we help you to access all course materials.</p>
            <a href="{{ route('front.pricing') }}"
                class="text-white font-semibold rounded-[30px] p-[16px_32px] bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980] w-fit">Check
                Pricing</a>
        </div>
    </section>
    <section id="Zero-to-Success"
        class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[50px] gap-[30px] bg-[#F5F8FA]">
        @include('components.front.testimonials')
    </section>
    @include('components.front.faq')
</x-front>

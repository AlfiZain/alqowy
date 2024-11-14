<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="text-black font-poppins pt-10 pb-[50px]">
    <!-- Page Content -->
    {{ $slot }}

    <!-- Footer -->
    <footer class="max-w-[1200px] mx-auto flex flex-col py-14 pb-[50px] px-4 md:px-12 bg-[#F5F8FA]">
        <div class="flex justify-center text-center">
            <div x-data="{ openSections: [] }"class="flex flex-col md:flex-row justify-between gap-5">
                <a href="{{ route('front.index') }}">
                    <div class="pr-2 py-2">
                        <img src="{{ asset('assets/logo/logo-black.svg') }}" alt="logo">
                    </div>
                </a>
                <!-- Section Component -->
                <template
                    x-for="(section, index) in [
                    { title: 'Products', items: ['Online Courses', 'Career Guidance', 'Expert Handbook', 'Interview Simulations'] },
                    { title: 'Company', items: ['About Us', 'Media Press', 'Careers', 'Developer APIs'], badgeIndex: 2, badgeText: 'We’re Hiring' },
                    { title: 'Resources', items: ['Blog', 'FAQ', 'Help Center', 'Terms & Conditions'] }]"
                    :key="index">
                    <div class="flex flex-col justify-center md:justify-start mt-4">
                        <p @click="openSections.includes(index) ? openSections = openSections.filter(i => i !== index) : openSections.push(index)"
                            class="font-semibold text-lg cursor-pointer mb-3">
                            <span x-text="section.title"></span>
                        </p>
                        <ul x-show="openSections.includes(index)" x-transition:enter="transition ease-out duration-1000"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-2"
                            class="flex flex-col gap-3 items-center">
                            <template x-for="(item, i) in section.items" :key="i">
                                <li class="flex items-center gap-2">
                                    <a href="" class="text-[#6D7786]" x-text="item"></a>
                                    <template x-if="section.badgeIndex === i">
                                        <div
                                            class="gradient-badge w-fit p-[6px_10px] rounded-full border border-[#FED6AD] flex items-center">
                                            <p class="font-medium text-xs text-[#FF6129]" x-text="section.badgeText">
                                            </p>
                                        </div>
                                    </template>
                                </li>
                            </template>
                        </ul>
                    </div>
                </template>
            </div>
        </div>
        <div class="w-full h-[51px] flex items-end border-t border-[#E7EEF2]">
            <p class="mx-auto text-sm text-[#6D7786] -tracking-[2%]">All Rights Reserved &copy; 2024 Muhammad Alfi Zain
            </p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>

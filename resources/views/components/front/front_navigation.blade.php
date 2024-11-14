<nav class="flex justify-between items-center py-6 px-4 md:px-14">
    <a href="{{ route('front.index') }}">
        <img src="{{ asset('assets/logo/logo.svg') }}" alt="logo">
    </a>
    <ul class="hidden md:flex items-center gap-[30px] text-white">
        <li>
            <a href="{{ route('front.index') }}" class="font-semibold">Home</a>
        </li>
        <li>
            <a href="{{ route('front.pricing') }}" class="font-semibold">Pricing</a>
        </li>
    </ul>

    @auth
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <div class="flex gap-[10px] items-center cursor-pointer">
                    <div class="flex flex-col items-end justify-center">
                        <p class="font-semibold text-white">Hi, {{ Auth::user()->name }}</p>
                        @if (Auth::user()->hasActiveSubscription())
                            <p class="p-[2px_10px] rounded-full bg-[#FF6129] font-semibold text-xs text-white text-center">
                                PRO</p>
                        @endif
                    </div>
                    <div class="w-[56px] h-[56px] overflow-hidden rounded-full flex shrink-0">
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" class="w-full h-full object-cover"
                            alt="photo">
                    </div>
                </div>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('dashboard')">
                    {{ __('Dashboard') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>

    @endauth
    @guest
        <div class="flex gap-[10px] items-center">
            <a href="{{ route('register') }}"
                class="text-white font-semibold rounded-[30px] px-4 py-2 md:px-8 md:py-4 ring-1 ring-white transition-all duration-300 hover:ring-2 hover:ring-[#FF6129]">Sign
                Up</a>
            <a href="{{ route('login') }}"
                class="text-white font-semibold rounded-[30px] px-4 py-2 md:px-8 md:py-4 bg-[#FF6129] transition-all duration-300 hover:shadow-[0_10px_20px_0_#FF612980]">Sign
                In</a>
        </div>
    @endguest
</nav>

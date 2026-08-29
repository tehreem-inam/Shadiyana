<header
    class="sticky top-0 z-40 h-[72px] border-b border-gray-200 bg-white shadow-sm"
>
    <div class="flex h-full items-center justify-between px-4 sm:px-6 lg:px-8">

        {{-- ============================================================
            LEFT
        ============================================================= --}}
        <div class="flex items-center gap-4">

            {{-- Mobile Menu --}}
            <button
                @click="sidebarOpen = !sidebarOpen"
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl
                       text-gray-500 transition
                       hover:bg-[#FBEBEF] hover:text-[#D7385E]
                       focus:outline-none focus:ring-2 focus:ring-[#D7385E]/20
                       lg:hidden"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </button>


            {{-- Mobile Logo --}}
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-2 lg:hidden"
            >

                <div
                    class="flex h-9 w-9 items-center justify-center
                           rounded-xl bg-[#D7385E] text-white shadow-sm"
                >
                    <span class="text-sm font-extrabold">
                        {{ strtoupper(substr(config('app.name', 'Shadiyana'), 0, 1)) }}
                    </span>
                </div>

                <div class="leading-tight">
                    <span class="block text-sm font-extrabold text-gray-900">
                        {{ config('app.name', 'Shadiyana') }}
                    </span>

                    <span class="block text-[9px] font-semibold uppercase tracking-widest text-gray-400">
                        Admin Panel
                    </span>
                </div>

            </a>

        </div>


        {{-- ============================================================
            RIGHT
        ============================================================= --}}
        <div class="flex items-center gap-2 sm:gap-3">

            {{-- ========================================================
                Notifications
            ========================================================= --}}
            <button
                type="button"
                class="relative flex h-10 w-10 items-center justify-center
                       rounded-xl text-gray-500 transition
                       hover:bg-[#FBEBEF] hover:text-[#D7385E]
                       focus:outline-none focus:ring-2 focus:ring-[#D7385E]/20"
            >

                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                    />
                </svg>

                {{-- Notification Dot --}}
                <span
                    class="absolute right-2 top-2 h-2 w-2 rounded-full bg-[#D7385E] ring-2 ring-white"
                ></span>

            </button>


            {{-- Divider --}}
            <div class="hidden h-8 w-px bg-gray-200 sm:block"></div>


            {{-- ========================================================
                USER DROPDOWN
            ========================================================= --}}
            @auth

                <div
                    class="relative"
                    x-data="{ userMenu: false }"
                >

                    {{-- User Button --}}
                    <button
                        type="button"
                        @click="userMenu = !userMenu"
                        @click.outside="userMenu = false"
                        class="flex items-center gap-2 rounded-xl px-2 py-1.5
                               transition hover:bg-gray-50
                               focus:outline-none"
                    >

                        {{-- Avatar --}}
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center
                                   overflow-hidden rounded-xl
                                   bg-[#FBEBEF] text-sm font-bold text-[#D7385E]"
                        >

                            @if(auth()->user()->profile_image)

                                <img
                                    src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                    alt="{{ auth()->user()->first_name }}"
                                    class="h-full w-full object-cover"
                                >

                            @else

                                {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}

                            @endif

                        </div>


                        {{-- User Information --}}
                        <div class="hidden text-left leading-tight sm:block">

                            <p class="max-w-[150px] truncate text-sm font-bold text-gray-900">
                                {{ auth()->user()->first_name }}
                                {{ auth()->user()->last_name }}
                            </p>

                            <p class="mt-0.5 text-[11px] font-medium text-gray-500">
                                {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}
                            </p>

                        </div>


                        {{-- Chevron --}}
                        <svg
                            class="hidden h-4 w-4 text-gray-400 transition sm:block"
                            :class="{ 'rotate-180': userMenu }"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>

                    </button>


                    {{-- ====================================================
                        DROPDOWN
                    ===================================================== --}}
                    <div
                        x-show="userMenu"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-3 w-64 origin-top-right
                               rounded-2xl border border-gray-200 bg-white
                               p-2 shadow-xl shadow-gray-200/50"
                        style="display: none;"
                    >

                        {{-- Dropdown User Info --}}
                        <div
                            class="mb-2 rounded-xl bg-[#FBEBEF] px-3 py-3"
                        >

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center
                                           overflow-hidden rounded-xl
                                           bg-white text-sm font-bold text-[#D7385E]"
                                >

                                    @if(auth()->user()->profile_image)

                                        <img
                                            src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                            alt="{{ auth()->user()->first_name }}"
                                            class="h-full w-full object-cover"
                                        >

                                    @else

                                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}

                                    @endif

                                </div>

                                <div class="min-w-0">

                                    <p class="truncate text-sm font-bold text-gray-900">
                                        {{ auth()->user()->first_name }}
                                        {{ auth()->user()->last_name }}
                                    </p>

                                    <p class="truncate text-xs text-gray-500">
                                        {{ auth()->user()->email }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Profile --}}
                        <a
                            href="{{ route('profile') }}"
                            class="flex items-center gap-3 rounded-xl px-3 py-2.5
                                   text-sm font-medium text-gray-700
                                   transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                        >

                            <span
                                class="flex h-8 w-8 items-center justify-center
                                       rounded-lg bg-gray-100 text-gray-500"
                            >
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                            </span>

                            <span>My Profile</span>

                        </a>


                        {{-- Change Password --}}
                        <a
                            href="{{ route('password.change') }}"
                            class="flex items-center gap-3 rounded-xl px-3 py-2.5
                                   text-sm font-medium text-gray-700
                                   transition hover:bg-[#FBEBEF] hover:text-[#D7385E]"
                        >

                            <span
                                class="flex h-8 w-8 items-center justify-center
                                       rounded-lg bg-gray-100 text-gray-500"
                            >
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 7a2 2 0 10-4 0v2m0 0H9a2 2 0 00-2 2v5a2 2 0 002 2h6a2 2 0 002-2v-5a2 2 0 00-2-2h-2zm0 0V7"
                                    />
                                </svg>
                            </span>

                            <span>Change Password</span>

                        </a>


                        {{-- Divider --}}
                        <div class="my-2 border-t border-gray-100"></div>


                        {{-- Logout --}}
                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5
                                       text-sm font-semibold text-red-600
                                       transition hover:bg-red-50"
                            >

                                <span
                                    class="flex h-8 w-8 items-center justify-center
                                           rounded-lg bg-red-50 text-red-500"
                                >
                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                        />
                                    </svg>
                                </span>

                                <span>Logout</span>

                            </button>

                        </form>

                    </div>

                </div>

            @else

                {{-- Guest --}}
                <a
                    href="{{ route('login') }}"
                    class="rounded-xl bg-[#D7385E] px-4 py-2 text-sm font-bold text-white
                           transition hover:bg-[#c42f52]"
                >
                    Login
                </a>

            @endauth

        </div>

    </div>
</header>
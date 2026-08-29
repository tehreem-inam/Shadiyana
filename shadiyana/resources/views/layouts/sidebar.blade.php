
<aside
    class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-gray-200 bg-white transition-transform duration-300 lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>

    {{-- ============================================================
        Logo
    ============================================================= --}}
    <div class="flex h-[72px] items-center border-b border-gray-100 px-6">

        <a
            href="{{ route('dashboard') }}"
            class="flex items-center gap-3"
        >

            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#D7385E] text-white shadow-sm shadow-[#D7385E]/20"
            >
                <span class="text-sm font-extrabold">
                    {{ strtoupper(substr(config('app.name', 'S'), 0, 1)) }}
                </span>
            </div>

            <div>
                <h1 class="text-base font-extrabold tracking-tight text-gray-900">
                    {{ config('app.name', 'Shadiyana') }}
                </h1>

                <p class="text-[10px] font-semibold uppercase tracking-widest text-gray-400">
                    Dashboard
                </p>
            </div>

        </a>

        {{-- Mobile Close --}}
        <button
            type="button"
            @click="sidebarOpen = false"
            class="ml-auto flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-700 lg:hidden"
            aria-label="Close sidebar"
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
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>

    </div>


    {{-- ============================================================
        Navigation
    ============================================================= --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6">


        {{-- ========================================================
            MAIN
        ========================================================= --}}
        <p class="mb-3 px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">
            Main
        </p>

        <div class="space-y-1">

            {{-- Dashboard --}}
            <a
                href="{{ route('dashboard') }}"
                class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
            >

                <svg
                    class="h-5 w-5 shrink-0
                    {{ request()->routeIs('dashboard')
                        ? 'text-[#D7385E]'
                        : 'text-gray-400 group-hover:text-gray-600' }}"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h4v-6h4v6h4a1 1 0 001-1V10"
                    />
                </svg>

                Dashboard

            </a>

        </div>


        {{-- ========================================================
            SUPER ADMIN NAVIGATION
        ========================================================= --}}
        @if(auth()->check() && auth()->user()->isSuperAdmin())

            <p class="mb-3 mt-8 px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                Administration
            </p>

            <div class="space-y-1">

                {{-- ====================================================
                    Users
                ===================================================== --}}
                <a
                    href="{{ route('users.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                    {{ request()->routeIs('users.*')
                        ? 'bg-[#FBEBEF] text-[#D7385E]'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                >

                    <svg
                        class="h-5 w-5 shrink-0
                        {{ request()->routeIs('users.*')
                            ? 'text-[#D7385E]'
                            : 'text-gray-400 group-hover:text-gray-600' }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m8-5a4 4 0 11-8 0 4 4 0 018 0zm4 1a3 3 0 10-3-3"
                        />
                    </svg>

                    Users

                </a>


                {{-- ====================================================
                    VENDOR MANAGEMENT
                ===================================================== --}}
                <p class="mb-3 mt-8 px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    Vendor Management
                </p>

                <div
                    x-data="{
                        vendorManagementOpen: {{ request()->routeIs('vendors.*') ? 'true' : 'false' }}
                    }"
                >

                    {{-- Vendor Management Toggle --}}
                    <button
                        type="button"
                        @click="vendorManagementOpen = !vendorManagementOpen"
                        class="group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                        {{
                            request()->routeIs('vendors.*')
                                ? 'bg-[#FBEBEF] text-[#D7385E]'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                        }}"
                    >

                        <svg
                            class="h-5 w-5 shrink-0
                            {{
                                request()->routeIs('vendors.*')
                                    ? 'text-[#D7385E]'
                                    : 'text-gray-400 group-hover:text-gray-600'
                            }}"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2
                                   M9 11a4 4 0 100-8 4 4 0 000 8
                                   M22 21v-2a4 4 0 00-3-3.87
                                   M16 3.13a4 4 0 010 7.75"
                            />
                        </svg>

                        <span class="flex-1 text-left">
                            Vendor Management
                        </span>

                        <svg
                            class="h-4 w-4 shrink-0 transition-transform duration-200"
                            :class="vendorManagementOpen ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 9l6 6 6-6"
                            />
                        </svg>

                    </button>


                    {{-- Vendor Management Submenu --}}
                    <div
                        x-show="vendorManagementOpen"
                        x-cloak
                        x-collapse
                        class="mt-1 space-y-1 pl-8"
                    >

                        {{-- Vendors --}}
                        <a
                            href="{{ route('vendors.index') }}"
                            class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                            {{
                                request()->routeIs('vendors.index')
                                || request()->routeIs('vendors.create')
                                || request()->routeIs('vendors.show')
                                || request()->routeIs('vendors.edit')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800'
                            }}"
                        >

                            <span
                                class="h-1.5 w-1.5 rounded-full
                                {{
                                    request()->routeIs('vendors.index')
                                    || request()->routeIs('vendors.create')
                                    || request()->routeIs('vendors.show')
                                    || request()->routeIs('vendors.edit')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300 group-hover:bg-gray-500'
                                }}"
                            ></span>

                            Vendors

                        </a>

                    </div>

                </div>


                {{-- ====================================================
                    CATALOG MANAGEMENT
                ===================================================== --}}
                <p class="mb-3 mt-8 px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    Catalog
                </p>

                <div
                    x-data="{
                        catalogOpen: {{
                            request()->routeIs('taxonomies.*')
                            || request()->routeIs('services.*')
                            || request()->routeIs('event-types.*')
                                ? 'true'
                                : 'false'
                        }}
                    }"
                >

                    {{-- Catalog Toggle --}}
                    <button
                        type="button"
                        @click="catalogOpen = !catalogOpen"
                        class="group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                        {{
                            request()->routeIs('taxonomies.*')
                            || request()->routeIs('services.*')
                            || request()->routeIs('event-types.*')
                                ? 'bg-[#FBEBEF] text-[#D7385E]'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                        }}"
                    >

                        <svg
                            class="h-5 w-5 shrink-0
                            {{
                                request()->routeIs('taxonomies.*')
                                || request()->routeIs('services.*')
                                || request()->routeIs('event-types.*')
                                    ? 'text-[#D7385E]'
                                    : 'text-gray-400 group-hover:text-gray-600'
                            }}"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M4 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1V5z
                                   M12 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1V5z
                                   M4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6z
                                   M12 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-6a1 1 0 01-1-1v-6z"
                            />
                        </svg>

                        <span class="flex-1 text-left">
                            Catalog
                        </span>

                        <svg
                            class="h-4 w-4 shrink-0 transition-transform duration-200"
                            :class="catalogOpen ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 9l6 6 6-6"
                            />
                        </svg>

                    </button>


                    {{-- Catalog Submenu --}}
                    <div
                        x-show="catalogOpen"
                        x-cloak
                        x-collapse
                        class="mt-1 space-y-1 pl-8"
                    >

                        {{-- Taxonomies --}}
                        <a
                            href="{{ route('taxonomies.index') }}"
                            class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                            {{
                                request()->routeIs('taxonomies.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800'
                            }}"
                        >

                            <span
                                class="h-1.5 w-1.5 rounded-full
                                {{
                                    request()->routeIs('taxonomies.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300 group-hover:bg-gray-500'
                                }}"
                            ></span>

                            Taxonomies

                        </a>


                        {{-- Services --}}
                        <a
                            href="{{ route('services.index') }}"
                            class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                            {{
                                request()->routeIs('services.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800'
                            }}"
                        >

                            <span
                                class="h-1.5 w-1.5 rounded-full
                                {{
                                    request()->routeIs('services.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300 group-hover:bg-gray-500'
                                }}"
                            ></span>

                            Services

                        </a>


                        {{-- Event Types --}}
                        <a
                            href="{{ route('event-types.index') }}"
                            class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                            {{
                                request()->routeIs('event-types.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800'
                            }}"
                        >

                            <span
                                class="h-1.5 w-1.5 rounded-full
                                {{
                                    request()->routeIs('event-types.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300 group-hover:bg-gray-500'
                                }}"
                            ></span>

                            Event Types

                        </a>

                    </div>

                </div>


                {{-- ====================================================
                    LOCATION MANAGEMENT
                ===================================================== --}}
                <p class="mb-3 mt-8 px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    System
                </p>

                <div
                    x-data="{
                        locationOpen: {{
                            request()->routeIs('locations.*')
                                ? 'true'
                                : 'false'
                        }}
                    }"
                >

                    {{-- Locations Toggle --}}
                    <button
                        type="button"
                        @click="locationOpen = !locationOpen"
                        class="group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                        {{
                            request()->routeIs('locations.*')
                                ? 'bg-[#FBEBEF] text-[#D7385E]'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                        }}"
                    >

                        <svg
                            class="h-5 w-5 shrink-0
                            {{
                                request()->routeIs('locations.*')
                                    ? 'text-[#D7385E]'
                                    : 'text-gray-400 group-hover:text-gray-600'
                            }}"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z"
                            />

                            <circle
                                cx="12"
                                cy="10"
                                r="2.5"
                                stroke-width="1.8"
                            />
                        </svg>

                        <span class="flex-1 text-left">
                            Locations
                        </span>

                        <svg
                            class="h-4 w-4 shrink-0 transition-transform duration-200"
                            :class="locationOpen ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 9l6 6 6-6"
                            />
                        </svg>

                    </button>


                    {{-- Locations Submenu --}}
                    <div
                        x-show="locationOpen"
                        x-cloak
                        x-collapse
                        class="mt-1 space-y-1 pl-8"
                    >

                        {{-- States --}}
                        <a
                            href="{{ route('locations.states.index') }}"
                            class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                            {{
                                request()->routeIs('locations.states.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800'
                            }}"
                        >

                            <span
                                class="h-1.5 w-1.5 rounded-full
                                {{
                                    request()->routeIs('locations.states.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300 group-hover:bg-gray-500'
                                }}"
                            ></span>

                            States

                        </a>


                        {{-- Cities --}}
                        <a
                            href="{{ route('locations.cities.index') }}"
                            class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium transition
                            {{
                                request()->routeIs('locations.cities.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800'
                            }}"
                        >

                            <span
                                class="h-1.5 w-1.5 rounded-full
                                {{
                                    request()->routeIs('locations.cities.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300 group-hover:bg-gray-500'
                                }}"
                            ></span>

                            Cities

                        </a>

                    </div>

                </div>

            </div>

        @endif


        {{-- ========================================================
            VENDOR AREA
        ========================================================= --}}
        @if(auth()->check() && auth()->user()->isVendor())

            <p class="mb-3 mt-8 px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                My Vendor
            </p>

            @php
                $currentVendor = auth()->user()->vendor;
            @endphp

            @if($currentVendor)

                <div class="space-y-1">

                    {{-- Vendor Profile --}}
                    <a
                        href="{{ route('vendors.show', $currentVendor) }}"
                        class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                        {{
                            request()->routeIs('vendors.show')
                                ? 'bg-[#FBEBEF] text-[#D7385E]'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                        }}"
                    >

                        <svg
                            class="h-5 w-5 shrink-0
                            {{
                                request()->routeIs('vendors.show')
                                    ? 'text-[#D7385E]'
                                    : 'text-gray-400 group-hover:text-gray-600'
                            }}"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-width="1.8"
                                d="M20 21a8 8 0 00-16 0M12 13a4 4 0 100-8 4 4 0 000 8z"
                            />
                        </svg>

                        Profile

                    </a>


                    {{-- Taxonomies --}}
                    <a
                        href="{{ route('vendors.taxonomies.index', ['vendor' => $currentVendor]) }}"
                        class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                        {{
                            request()->routeIs('vendors.taxonomies.*')
                                ? 'bg-[#FBEBEF] text-[#D7385E]'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                        }}"
                    >

                        <span
                            class="h-2 w-2 rounded-full
                            {{
                                request()->routeIs('vendors.taxonomies.*')
                                    ? 'bg-[#D7385E]'
                                    : 'bg-gray-300'
                            }}"
                        ></span>

                        Taxonomies

                    </a>


                    {{-- Services --}}
                    <a
                        href="{{ route('vendors.services.index', ['vendor' => $currentVendor]) }}"
                        class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                        {{
                            request()->routeIs('vendors.services.*')
                                ? 'bg-[#FBEBEF] text-[#D7385E]'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                        }}"
                    >

                        <span
                            class="h-2 w-2 rounded-full
                            {{
                                request()->routeIs('vendors.services.*')
                                    ? 'bg-[#D7385E]'
                                    : 'bg-gray-300'
                            }}"
                        ></span>

                        Services

                    </a>


                    {{-- Event Types --}}
                    <a
                        href="{{ route('vendors.event-types.index', ['vendor' => $currentVendor]) }}"
                        class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                        {{
                            request()->routeIs('vendors.event-types.*')
                                ? 'bg-[#FBEBEF] text-[#D7385E]'
                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                        }}"
                    >

                        <span
                            class="h-2 w-2 rounded-full
                            {{
                                request()->routeIs('vendors.event-types.*')
                                    ? 'bg-[#D7385E]'
                                    : 'bg-gray-300'
                            }}"
                        ></span>

                        Event Types

                    </a>


                    {{-- Gallery --}}
                    @if(Route::has('vendors.images.index'))
                        <a
                            href="{{ route('vendors.images.index', ['vendor' => $currentVendor]) }}"
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                            {{
                                request()->routeIs('vendors.images.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                            }}"
                        >

                            <span
                                class="h-2 w-2 rounded-full
                                {{
                                    request()->routeIs('vendors.images.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300'
                                }}"
                            ></span>

                            Gallery

                        </a>
                    @endif


                    {{-- Packages --}}
                    @if(Route::has('vendors.packages.index'))
                        <a
                            href="{{ route('vendors.packages.index', ['vendor' => $currentVendor]) }}"
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                            {{
                                request()->routeIs('vendors.packages.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                            }}"
                        >

                            <span
                                class="h-2 w-2 rounded-full
                                {{
                                    request()->routeIs('vendors.packages.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300'
                                }}"
                            ></span>

                            Packages

                        </a>
                    @endif


                    {{-- Availability --}}
                    @if(Route::has('vendors.availability.index'))
                        <a
                            href="{{ route('vendors.availability.index', ['vendor' => $currentVendor]) }}"
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                            {{
                                request()->routeIs('vendors.availability.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                            }}"
                        >

                            <span
                                class="h-2 w-2 rounded-full
                                {{
                                    request()->routeIs('vendors.availability.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300'
                                }}"
                            ></span>

                            Availability

                        </a>
                    @endif


                    {{-- Deals --}}
                    @if(Route::has('vendors.deals.index'))
                        <a
                            href="{{ route('vendors.deals.index', ['vendor' => $currentVendor]) }}"
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                            {{
                                request()->routeIs('vendors.deals.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                            }}"
                        >

                            <span
                                class="h-2 w-2 rounded-full
                                {{
                                    request()->routeIs('vendors.deals.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300'
                                }}"
                            ></span>

                            Deals

                        </a>
                    @endif


                    {{-- Inquiries --}}
                    @if(Route::has('vendors.inquiries.index'))
                        <a
                            href="{{ route('vendors.inquiries.index', ['vendor' => $currentVendor]) }}"
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                            {{
                                request()->routeIs('vendors.inquiries.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                            }}"
                        >

                            <span
                                class="h-2 w-2 rounded-full
                                {{
                                    request()->routeIs('vendors.inquiries.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300'
                                }}"
                            ></span>

                            Inquiries

                        </a>
                    @endif


                    {{-- Bookings --}}
                    @if(Route::has('vendors.bookings.index'))
                        <a
                            href="{{ route('vendors.bookings.index', ['vendor' => $currentVendor]) }}"
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                            {{
                                request()->routeIs('vendors.bookings.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                            }}"
                        >

                            <span
                                class="h-2 w-2 rounded-full
                                {{
                                    request()->routeIs('vendors.bookings.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300'
                                }}"
                            ></span>

                            Bookings

                        </a>
                    @endif


                    {{-- Reviews --}}
                    @if(Route::has('vendors.reviews.index'))
                        <a
                            href="{{ route('vendors.reviews.index', ['vendor' => $currentVendor]) }}"
                            class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                            {{
                                request()->routeIs('vendors.reviews.*')
                                    ? 'bg-[#FBEBEF] text-[#D7385E]'
                                    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                            }}"
                        >

                            <span
                                class="h-2 w-2 rounded-full
                                {{
                                    request()->routeIs('vendors.reviews.*')
                                        ? 'bg-[#D7385E]'
                                        : 'bg-gray-300'
                                }}"
                            ></span>

                            Reviews

                        </a>
                    @endif

                </div>

            @else

                <div class="rounded-xl bg-gray-50 px-4 py-3">
                    <p class="text-xs font-medium leading-5 text-gray-500">
                        No vendor profile is associated with your account.
                    </p>
                </div>

            @endif

        @endif


        {{-- ========================================================
            ACCOUNT
        ========================================================= --}}
        <p class="mb-3 mt-8 px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400">
            Account
        </p>

        <div class="space-y-1">

            {{-- Profile --}}
            @if(Route::has('profile'))

                <a
                    href="{{ route('profile') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                    {{
                        request()->routeIs('profile')
                            ? 'bg-[#FBEBEF] text-[#D7385E]'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                    }}"
                >

                    <svg
                        class="h-5 w-5 shrink-0
                        {{
                            request()->routeIs('profile')
                                ? 'text-[#D7385E]'
                                : 'text-gray-400 group-hover:text-gray-600'
                        }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="M20 21a8 8 0 00-16 0M12 13a4 4 0 100-8 4 4 0 000 8z"
                        />
                    </svg>

                    My Profile

                </a>

            @endif


            {{-- Change Password --}}
            @if(Route::has('password.change'))

                <a
                    href="{{ route('password.change') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition
                    {{
                        request()->routeIs('password.*')
                            ? 'bg-[#FBEBEF] text-[#D7385E]'
                            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                    }}"
                >

                    <svg
                        class="h-5 w-5 shrink-0
                        {{
                            request()->routeIs('password.*')
                                ? 'text-[#D7385E]'
                                : 'text-gray-400 group-hover:text-gray-600'
                        }}"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15 7a4 4 0 10-5.2 3.8L4 16.6V20h3.4l1.5-1.5H11V16h2.5l1.8-1.8A4 4 0 0015 7z"
                        />
                    </svg>

                    Change Password

                </a>

            @endif

        </div>

    </nav>


    {{-- ============================================================
        Bottom User Area
    ============================================================= --}}
    <div class="border-t border-gray-100 p-4">

        <div class="rounded-xl bg-[#FBEBEF] p-3">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-white text-xs font-bold text-[#D7385E]"
                >
                    @auth
                        {{ strtoupper(substr(auth()->user()->first_name ?? 'U', 0, 1)) }}
                    @else
                        U
                    @endauth
                </div>

                <div class="min-w-0 flex-1">

                    <p class="truncate text-xs font-bold text-gray-900">
                        @auth
                            {{ auth()->user()->first_name }}
                            {{ auth()->user()->last_name }}
                        @else
                            User
                        @endauth
                    </p>

                    <p class="truncate text-[10px] font-medium text-gray-500">
                        @auth
                            {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}
                        @else
                            Guest
                        @endauth
                    </p>

                </div>

            </div>

        </div>

    </div>

</aside>


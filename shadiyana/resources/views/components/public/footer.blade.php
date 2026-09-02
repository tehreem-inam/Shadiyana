{{-- ============================================================
    SHADIYANA — PUBLIC FOOTER
============================================================= --}}

<footer class="border-t border-[#F1F1F1] bg-white">

    {{-- ========================================================
        MAIN FOOTER
    ========================================================= --}}
    <div class="mx-auto max-w-7xl px-5 py-14 sm:px-6 lg:px-8 lg:py-16">

        <div class="grid gap-12 lg:grid-cols-[1.15fr_1fr_1fr_1fr] lg:gap-16">

            {{-- ==================================================
                BRAND / NEWSLETTER / SUGGESTION
            =================================================== --}}
            <div>

                {{-- Logo --}}
                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center"
                    aria-label="Shadiyana Home"
                >
                    <div class="flex items-center gap-2.5">

                        {{-- Logo Mark --}}
                        <div class="relative flex h-10 w-10 items-center justify-center">

                            {{-- Rings --}}
                            <span
                                class="absolute left-[7px] top-[9px] h-6 w-6 rounded-full border-[2px] border-[#D7385E]"
                            ></span>

                            <span
                                class="absolute left-[14px] top-[9px] h-6 w-6 rounded-full border-[2px] border-[#D7385E]"
                            ></span>

                            {{-- Diamond --}}
                            <span
                                class="absolute left-[16px] top-[4px] h-[7px] w-[7px] rotate-45 rounded-[1px] border-[1.5px] border-[#D7385E] bg-white"
                            ></span>

                            {{-- Small heart --}}
                            <span
                                class="absolute right-[1px] top-[2px] text-[11px] leading-none text-[#D7385E]"
                            >
                                ♥
                            </span>

                        </div>

                        <span
                            class="text-[28px] font-bold tracking-[-0.04em] text-[#132743]"
                        >
                            Shadiyana
                        </span>

                    </div>
                </a>


                {{-- Description --}}
                <p
                    class="mt-5 max-w-sm text-sm leading-6 text-gray-500"
                >
                    Discover wedding venues, services and trusted vendors
                    to plan your perfect Shadi, all in one place.
                </p>


                {{-- ==================================================
                    NEWSLETTER
                =================================================== --}}
                <div class="mt-7">

                    <p
                        class="mb-3 text-sm font-semibold text-[#132743]"
                    >
                        Stay updated
                    </p>

                    <form
                        action="#"
                        method="POST"
                        class="flex max-w-[430px] items-center rounded-full border border-[#E4E7EA] bg-white p-1.5 shadow-[0_10px_30px_rgba(19,39,67,0.06)]"
                    >

                        @csrf

                        <label for="footer-email" class="sr-only">
                            Email address
                        </label>

                        <input
                            id="footer-email"
                            type="email"
                            name="email"
                            placeholder="Enter Email"
                            required
                            class="min-w-0 flex-1 border-0 bg-transparent px-4 py-3 text-sm text-[#132743] outline-none placeholder:text-gray-400 focus:ring-0"
                        >

                        <button
                            type="submit"
                            class="shrink-0 rounded-full bg-[#D7385E] px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-[#C22C50] hover:shadow-md"
                        >
                            Stay Updated
                        </button>

                    </form>

                </div>


                {{-- ==================================================
                    SUGGESTION FORM
                =================================================== --}}
                <div class="mt-9">

                    <h3
                        class="text-[18px] font-semibold tracking-tight text-[#132743]"
                    >
                        Got any suggestions for us?
                    </h3>

                    <form
                        action="#"
                        method="POST"
                        class="relative mt-4 max-w-[560px] overflow-hidden rounded-2xl border border-[#F0F0F0] bg-white shadow-[0_8px_24px_rgba(19,39,67,0.08)]"
                    >

                        @csrf

                        <label for="footer-suggestion" class="sr-only">
                            Your suggestion
                        </label>

                        <textarea
                            id="footer-suggestion"
                            name="suggestion"
                            rows="5"
                            placeholder="Type here..."
                            class="block w-full resize-none border-0 bg-transparent px-5 py-5 pb-20 text-sm text-[#132743] outline-none placeholder:text-gray-400 focus:ring-0"
                        ></textarea>

                        <div class="absolute bottom-3 right-3">
                            <button
                                type="submit"
                                class="rounded-xl bg-[#E99AB0] px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-[#D7385E]"
                            >
                                Submit
                            </button>
                        </div>

                    </form>

                </div>

            </div>


            {{-- ==================================================
                COMPANY
            =================================================== --}}
            <div>

                <h3
                    class="text-[17px] font-bold text-[#D7385E]"
                >
                    Company
                </h3>

                <ul class="mt-6 space-y-4">

                    <li>
                        <a
                            href="{{ url('/#about') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            About Us
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/contact') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Contact Us
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/shadiyana/list') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Find Vendors
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/vendor/register') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            List Your Business
                        </a>
                    </li>

                </ul>

            </div>


            {{-- ==================================================
                SERVICES
            =================================================== --}}
            <div>

                <h3
                    class="text-[17px] font-bold text-[#D7385E]"
                >
                    Services
                </h3>

                <ul class="mt-6 space-y-4">

                    <li>
                        <a
                            href="{{ url('/shadiyana/list/services') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Wedding Services
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/shadiyana/list/events') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Wedding Events
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/shadiyana/list') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Wedding Venues
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/shadiyana/list') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Wedding Vendors
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/shadiyana/list') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Explore Weddings
                        </a>
                    </li>

                </ul>

            </div>


            {{-- ==================================================
                RESOURCES
            =================================================== --}}
            <div>

                <h3
                    class="text-[17px] font-bold text-[#D7385E]"
                >
                    Resources
                </h3>

                <ul class="mt-6 space-y-4">

                    <li>
                        <a
                            href="{{ url('/shadiyana/list?city=lahore') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Vendors in Lahore
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/shadiyana/list?city=islamabad') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Vendors in Islamabad
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/shadiyana/list?city=karachi') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Vendors in Karachi
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/privacy-policy') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Privacy Policy
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/terms-and-conditions') }}"
                            class="text-sm text-[#132743] transition hover:text-[#D7385E]"
                        >
                            Terms &amp; Conditions
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </div>


    {{-- ========================================================
        BOTTOM BAR
    ========================================================= --}}
    <div class="border-t border-[#F1F1F1]">

        <div
            class="mx-auto flex max-w-7xl flex-col gap-4 px-5 py-5 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8"
        >

            {{-- Copyright --}}
            <p class="text-xs text-gray-400">
                © {{ date('Y') }} Shadiyana. All rights reserved.
            </p>


            {{-- Social Links --}}
            <div class="flex items-center gap-2">

                {{-- Facebook --}}
                <a
                    href="#"
                    aria-label="Facebook"
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E] transition hover:bg-[#D7385E] hover:text-white"
                >
                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path d="M14 8h3V4h-3c-3.31 0-5 1.69-5 5v3H6v4h3v8h4v-8h3.5l.5-4H13V9c0-.67.33-1 1-1z"/>
                    </svg>
                </a>


                {{-- Instagram --}}
                <a
                    href="#"
                    aria-label="Instagram"
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E] transition hover:bg-[#D7385E] hover:text-white"
                >
                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <rect
                            x="3"
                            y="3"
                            width="18"
                            height="18"
                            rx="5"
                        />
                        <circle
                            cx="12"
                            cy="12"
                            r="4"
                        />
                        <circle
                            cx="17.5"
                            cy="6.5"
                            r="1"
                            fill="currentColor"
                            stroke="none"
                        />
                    </svg>
                </a>


                {{-- WhatsApp --}}
                <a
                    href="#"
                    aria-label="WhatsApp"
                    class="flex h-9 w-9 items-center justify-center rounded-full bg-[#FBEBEF] text-[#D7385E] transition hover:bg-[#D7385E] hover:text-white"
                >
                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M20 11.5a8 8 0 01-11.8 7L4 20l1.5-4.1A8 8 0 1120 11.5z"/>
                        <path d="M8.5 9.5c.3 1.8 2.2 4 4.2 4.8"/>
                    </svg>
                </a>

            </div>


            {{-- Made with --}}
            <p class="hidden text-xs text-gray-400 md:block">
                Made for your perfect Shadi.
            </p>

        </div>

    </div>

</footer>
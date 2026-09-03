@extends('layouts.public')

@section('title', 'Wedding Events | Shadiyana')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,450;9..144,550;9..144,650&family=Inter:wght@400;500;600;700&display=swap');

    .font-display { font-family: 'Fraunces', ui-serif, Georgia, serif; }
    .font-body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }

    @media (prefers-reduced-motion: no-preference) {
        .shd-rise {
            animation: shd-rise .7s cubic-bezier(.2,.7,.2,1) both;
        }
        .shd-rise-delay {
            animation: shd-rise .7s cubic-bezier(.2,.7,.2,1) .12s both;
        }
        @keyframes shd-rise {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    }
</style>

<div class="min-h-screen bg-[#FFFBF6] font-body">

    {{-- ============================================================
        PUBLIC NAVBAR
    ============================================================= --}}

    <x-public.home-navbar
        :venue-taxonomies="$venueTaxonomies"
        :services="$services"
        :event-types="$eventTypes"
        :cities="$cities"
    />


    {{-- ============================================================
        HERO
    ============================================================= --}}

    <section class="relative overflow-hidden border-b border-[#F0DCE1]">

        {{-- Background photograph --}}
        <div class="absolute inset-0">

            <img
                src="{{ asset('images/events-hero.png') }}"
                alt="A floral mandap set up at sunset by the sea"
                class="h-full w-full object-cover"
            >

            {{-- Readability gradients over the photo --}}
            <!-- <div class="absolute inset-0 bg-gradient-to-r from-white/85 via-white/45 to-[#241019]/10"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#241019]/50 via-transparent to-transparent"></div> -->

        </div>


        <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8 lg:py-32">

            <div class="shd-rise max-w-xl">

                {{-- Breadcrumb --}}
                <div class="mb-6 flex items-center gap-2 text-sm text-black/70">

                    <a href="{{ url('/') }}" class="transition hover:text-black">
                        Home
                    </a>

                    <svg class="h-3.5 w-3.5 text-black/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m9 18 6-6-6-6" />
                    </svg>

                    <span class="font-medium text-black">Events</span>

                </div>


                <h1 class="font-display text-4xl font-medium leading-[1.1] tracking-tight text-black sm:text-5xl">
                    Every celebration<br class="hidden sm:block">
                    has its own vendors.
                </h1>


                <p class="mt-5 max-w-md text-[15px] leading-7 text-black/80 sm:text-base">
                    From the mehndi to the walima, pick the occasion you're
                    planning and we'll line up the venues, photographers,
                    decorators and makeup artists who know it best.
                </p>


                {{-- Event count --}}
                <div class="mt-8 inline-flex items-center gap-2 rounded-full border border-black/25 bg-white/10 px-4 py-2 text-sm text-black/90 backdrop-blur">
                    <svg class="h-4 w-4 text-[#EBC46B]" viewBox="0 0 64 64" fill="none">
                        <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" />
                        <circle cx="19" cy="46" r="4" fill="currentColor" />
                    </svg>

                    <strong class="font-display font-medium text-black">
                        {{ $eventTypes->count() }}
                    </strong>
                    {{ $eventTypes->count() === 1 ? 'event' : 'events' }} ready to explore
                </div>

            </div>

        </div>

    </section>



    {{-- ============================================================
        EVENTS
    ============================================================= --}}

    <main class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">

        {{-- Section heading --}}
        <div class="mb-10 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">

            <div>
                <div class="mb-3 flex items-center gap-2 text-sm font-medium text-[#C6952F]">
                    <svg class="h-4 w-4" viewBox="0 0 64 64" fill="none">
                        <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" />
                        <circle cx="19" cy="46" r="4" fill="currentColor" />
                    </svg>
                    Wedding events
                </div>

                <h2 class="font-display text-2xl font-medium tracking-tight text-[#241019] sm:text-3xl">
                    Choose your celebration
                </h2>
            </div>

            <p class="max-w-sm text-sm leading-6 text-gray-500 sm:text-right">
                Every card below opens onto vendors curated for that
                specific occasion.
            </p>

        </div>


        {{-- ========================================================
            EVENT GRID
        ========================================================= --}}

        @if($eventTypes->isNotEmpty())

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                @foreach($eventTypes as $event)

                    @php
                        $eventImage = null;

                        if ($event->images->isNotEmpty()) {
                            $eventImage = asset(
                                'storage/' . $event->images->first()->path
                            );
                        } elseif (!empty($event->image)) {
                            $eventImage = asset(
                                'storage/' . $event->image
                            );
                        }
                    @endphp


                    <a
                        href="{{ route('events.show', [
                            'slug' => $event->slug,
                        ]) }}"
                        class="group relative flex flex-col overflow-hidden rounded-xl border border-[#EEE1CB] bg-white shadow-[0_1px_2px_rgba(36,16,25,0.04)] transition duration-300 hover:-translate-y-1 hover:border-[#C6952F]/60 hover:shadow-[0_16px_32px_-16px_rgba(122,16,48,0.25)]"
                    >

                        {{-- ==================================================
                            IMAGE
                        =================================================== --}}

                        <div class="relative aspect-[16/10] overflow-hidden bg-[#FBEBEF]">

                            @if($eventImage)

                                <img
                                    src="{{ $eventImage }}"
                                    alt="{{ $event->name }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >

                            @else

                                <div class="flex h-full w-full items-center justify-center">

                                    <svg class="h-10 w-10 text-[#D7385E]/70" viewBox="0 0 64 64" fill="none">
                                        <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
                                        <circle cx="19" cy="46" r="4" fill="currentColor" />
                                    </svg>

                                </div>

                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-transparent to-transparent opacity-0 transition group-hover:opacity-100"></div>

                            {{-- Corner motif tag --}}
                            <div class="absolute left-3 top-3 flex h-8 w-8 items-center justify-center rounded-full bg-white/90 text-[#D7385E] shadow-sm backdrop-blur">
                                <svg class="h-4 w-4" viewBox="0 0 64 64" fill="none">
                                    <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="4.5" stroke-linecap="round" />
                                    <circle cx="19" cy="46" r="4" fill="currentColor" />
                                </svg>
                            </div>

                        </div>


                        {{-- ==================================================
                            CONTENT
                        =================================================== --}}

                        <div class="flex flex-1 flex-col p-5">

                            <h3 class="font-display text-lg font-medium text-[#241019] transition group-hover:text-[#A62347]">
                                {{ $event->name }}
                            </h3>


                            @if(!empty($event->description))

                                <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-500">
                                    {{ \Illuminate\Support\Str::limit(
                                        strip_tags($event->description),
                                        110
                                    ) }}
                                </p>

                            @else

                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    Explore vendors and services for
                                    {{ strtolower($event->name) }}.
                                </p>

                            @endif


                            <div class="mt-4 flex items-center gap-1.5 border-t border-dashed border-[#EEE1CB] pt-4 text-sm font-semibold text-[#D7385E]">
                                View vendors
                                <svg
                                    class="h-3.5 w-3.5 transition-transform duration-300 group-hover:translate-x-1"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-6-6 6 6-6 6" />
                                </svg>
                            </div>

                        </div>

                    </a>

                @endforeach

            </div>

        @else

            {{-- ========================================================
                EMPTY STATE
            ========================================================= --}}

            <div class="rounded-2xl border border-dashed border-[#EEE1CB] bg-[#FFFCF8] px-6 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#FBEBEF]">
                    <svg class="h-8 w-8 text-[#D7385E]" viewBox="0 0 64 64" fill="none">
                        <path d="M32 6c14 0 22 10 22 22 0 10-7 17-16 17-6 0-10-4-10-9 0-4 3-7 7-7 3 0 5 2 5 5 0 2-1 3-3 3" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" />
                        <circle cx="19" cy="46" r="3.5" fill="currentColor" />
                    </svg>
                </div>


                <h2 class="mt-5 font-display text-xl font-medium text-[#241019]">
                    No events available yet
                </h2>


                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                    We're not hosting any active wedding events right now.
                    Check back soon — new celebrations get added often.
                </p>


                <a
                    href="{{ url('/') }}"
                    class="mt-6 inline-flex items-center gap-2 rounded-full bg-[#D7385E] px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#A62347]"
                >
                    Back to home
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 12h14" />
                    </svg>
                </a>

            </div>

        @endif

    </main>

</div>

@endsection
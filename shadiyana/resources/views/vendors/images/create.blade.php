@extends('layouts.app')

@section('title', 'Upload Gallery Images')

@section('content')

<div class="mx-auto max-w-7xl">

```
{{-- ============================================================
    PAGE HEADER
============================================================= --}}

<div class="mb-8">

    <div class="mb-3 flex flex-wrap items-center gap-2 text-sm text-gray-400">

        <a
            href="{{ route('dashboard') }}"
            class="transition hover:text-[#D7385E]"
        >
            Dashboard
        </a>

        <span>/</span>

        <a
            href="{{ route('vendors.images.index', ['vendor' => $vendor->id]) }}"
            class="transition hover:text-[#D7385E]"
        >
            Gallery
        </a>

        <span>/</span>

        <span class="text-gray-600">
            Upload
        </span>

    </div>


    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>

            <div class="mb-2 inline-flex items-center gap-2 rounded-full bg-[#FBEBEF] px-3 py-1 text-xs font-semibold text-[#D7385E]">

                <span class="h-1.5 w-1.5 rounded-full bg-[#D7385E]"></span>

                {{ $isAdmin ? 'Admin Gallery Management' : 'Vendor Gallery' }}

            </div>

            <h1 class="text-2xl font-bold tracking-tight text-gray-900">
                Upload Gallery Images
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Add professional images to showcase
                <span class="font-semibold text-gray-700">
                    {{ $vendor->business_name }}
                </span>
            </p>

        </div>


        <a
            href="{{ route('vendors.images.index', ['vendor' => $vendor->id]) }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-[#D7385E]/30 hover:bg-[#FBEBEF] hover:text-[#D7385E]"
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
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                />
            </svg>

            Back to Gallery

        </a>

    </div>

</div>


{{-- ============================================================
    VALIDATION ERRORS
============================================================= --}}

@if ($errors->any())

    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

        <div class="flex gap-3">

            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">

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
                        d="M12 8v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.52 20h14.96a2 2 0 001.73-3.14l-7.5-13a2 2 0 00-3.42 0z"
                    />
                </svg>

            </div>

            <div>

                <h3 class="text-sm font-bold text-red-800">
                    Please fix the following errors
                </h3>

                <ul class="mt-2 space-y-1 text-sm text-red-700">

                    @foreach ($errors->all() as $error)

                        <li class="flex gap-2">
                            <span>•</span>
                            <span>{{ $error }}</span>
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

@endif


<form
    action="{{ route('vendors.images.store', ['vendor' => $vendor->id]) }}"
    method="POST"
    enctype="multipart/form-data"
    id="galleryUploadForm"
>

    @csrf


    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


        {{-- ====================================================
            MAIN COLUMN
        ===================================================== --}}

        <div class="space-y-6 lg:col-span-2">


            {{-- Admin Vendor Selector --}}
            @if ($isAdmin)

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">

                    <div class="mb-5 flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 21a2 2 0 01-2.828 0l-4.243-4.343a8 8 0 1111.314 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2 class="text-base font-bold text-gray-900">
                                Select Vendor
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Choose the vendor whose gallery you want to manage.
                            </p>

                        </div>

                    </div>


                    <select
                        id="vendorSelector"
                        onchange="changeVendor(this.value)"
                        class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm font-medium text-gray-800 outline-none transition focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                    >

                        @foreach ($vendors as $item)

                            <option
                                value="{{ $item->id }}"
                                @selected($item->id == $vendor->id)
                            >
                                {{ $item->business_name }}
                                @if ($item->city)
                                    — {{ $item->city->name }}
                                @endif
                            </option>

                        @endforeach

                    </select>

                </div>

            @endif


            {{-- Upload Card --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5">

                    <div class="flex items-start gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E]">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2 class="text-base font-bold text-gray-900">
                                Gallery Images
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Upload multiple images at once.
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <label
                        for="images"
                        id="dropZone"
                        class="group relative flex min-h-[360px] cursor-pointer flex-col items-center justify-center overflow-hidden rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50 px-6 py-12 text-center transition hover:border-[#D7385E]/50 hover:bg-[#FBEBEF]/40"
                    >

                        <input
                            type="file"
                            name="images[]"
                            id="images"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            multiple
                            class="sr-only"
                        >


                        {{-- Empty State --}}
                        <div
                            id="uploadPlaceholder"
                            class="flex flex-col items-center"
                        >

                            <div class="mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#FBEBEF] text-[#D7385E] transition group-hover:scale-105">

                                <svg
                                    class="h-7 w-7"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 16V4m0 0L7.5 8.5M12 4l4.5 4.5M5 20h14a2 2 0 002-2v-3a2 2 0 00-2-2h-1m-10 0H5a2 2 0 00-2 2v3a2 2 0 002 2z"
                                    />
                                </svg>

                            </div>

                            <h3 class="text-base font-bold text-gray-900">
                                Drop your images here
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                or
                                <span class="font-semibold text-[#D7385E]">
                                    browse from your computer
                                </span>
                            </p>

                            <div class="mt-5 flex flex-wrap justify-center gap-2">

                                @foreach (['JPG', 'JPEG', 'PNG', 'WEBP'] as $format)

                                    <span class="rounded-full bg-white px-3 py-1 text-xs font-medium text-gray-500 ring-1 ring-gray-200">
                                        {{ $format }}
                                    </span>

                                @endforeach

                            </div>

                            <p class="mt-3 text-xs text-gray-400">
                                Maximum 30 images · 5 MB per image
                            </p>

                        </div>


                        {{-- Preview --}}
                        <div
                            id="previewContainer"
                            class="hidden w-full"
                        >

                            <div class="mb-4 flex items-center justify-between">

                                <div>

                                    <p class="text-sm font-bold text-gray-900">
                                        Selected Images
                                    </p>

                                    <p
                                        id="imageCount"
                                        class="mt-0.5 text-xs text-gray-500"
                                    >
                                        0 images selected
                                    </p>

                                </div>

                                <span class="rounded-full bg-[#FBEBEF] px-3 py-1 text-xs font-semibold text-[#D7385E]">
                                    Ready to upload
                                </span>

                            </div>


                            <div
                                id="previewGrid"
                                class="grid grid-cols-2 gap-3 sm:grid-cols-3 md:grid-cols-4"
                            ></div>


                            <div class="mt-5 flex justify-center">

                                <span class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2 text-xs font-semibold text-gray-600 shadow-sm ring-1 ring-gray-200">

                                    <svg
                                        class="h-4 w-4 text-[#D7385E]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-width="2"
                                            d="M12 4v16m8-8H4"
                                        />
                                    </svg>

                                    Click to replace selection

                                </span>

                            </div>

                        </div>

                    </label>

                </div>

            </div>

        </div>


        {{-- ====================================================
            SIDEBAR
        ===================================================== --}}

        <div class="space-y-6">


            {{-- Details --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5">

                    <h2 class="text-base font-bold text-gray-900">
                        Image Details
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Applied to all selected images.
                    </p>

                </div>


                <div class="space-y-5 p-6">

                    <div>

                        <label
                            for="title"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Title
                            <span class="font-normal text-gray-400">
                                (Optional)
                            </span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            maxlength="255"
                            placeholder="e.g. Wedding Hall"
                            class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                        >

                    </div>


                    <div>

                        <label
                            for="description"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Description
                            <span class="font-normal text-gray-400">
                                (Optional)
                            </span>
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="6"
                            maxlength="2000"
                            placeholder="Describe these gallery images..."
                            class="block w-full resize-none rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm leading-6 text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#D7385E] focus:bg-white focus:ring-4 focus:ring-[#D7385E]/10"
                        >{{ old('description') }}</textarea>

                        <div class="mt-2 flex justify-between text-xs text-gray-400">

                            <span>
                                Optional
                            </span>

                            <span>
                                <span id="descriptionCount">0</span>/2000
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Guidelines --}}
            <div class="rounded-3xl border border-[#D7385E]/10 bg-[#FBEBEF] p-6">

                <div class="flex gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-[#D7385E]">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="text-sm font-bold text-gray-900">
                            Upload Guidelines
                        </h3>

                        <ul class="mt-3 space-y-2 text-xs leading-5 text-gray-600">

                            <li>• Use clear, high-quality photos.</li>
                            <li>• Maximum 30 images per upload.</li>
                            <li>• Maximum 5 MB per image.</li>
                            <li>• JPG, PNG and WEBP supported.</li>

                        </ul>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="flex flex-col gap-3">

                <a
                    href="{{ route('vendors.images.index', ['vendor' => $vendor->id]) }}"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    id="uploadButton"
                    disabled
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#D7385E] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#c52f52] focus:outline-none focus:ring-4 focus:ring-[#D7385E]/20 disabled:cursor-not-allowed disabled:opacity-40"
                >

                    <svg
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                        />
                    </svg>

                    Upload Images

                </button>

            </div>

        </div>

    </div>

</form>
```

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const fileInput = document.getElementById('images');
    const dropZone = document.getElementById('dropZone');

    const placeholder =
        document.getElementById('uploadPlaceholder');

    const previewContainer =
        document.getElementById('previewContainer');

    const previewGrid =
        document.getElementById('previewGrid');

    const imageCount =
        document.getElementById('imageCount');

    const uploadButton =
        document.getElementById('uploadButton');

    const description =
        document.getElementById('description');

    const descriptionCount =
        document.getElementById('descriptionCount');


    /*
    |--------------------------------------------------------------------------
    | File Selection
    |--------------------------------------------------------------------------
    */

    fileInput.addEventListener('change', function () {

        handleFiles(Array.from(this.files));

    });


    /*
    |--------------------------------------------------------------------------
    | Drag & Drop
    |--------------------------------------------------------------------------
    */

    ['dragenter', 'dragover'].forEach(function (eventName) {

        dropZone.addEventListener(eventName, function (event) {

            event.preventDefault();
            event.stopPropagation();

            dropZone.classList.add(
                'border-[#D7385E]',
                'bg-[#FBEBEF]'
            );

        });

    });


    ['dragleave', 'drop'].forEach(function (eventName) {

        dropZone.addEventListener(eventName, function (event) {

            event.preventDefault();
            event.stopPropagation();

            dropZone.classList.remove(
                'border-[#D7385E]',
                'bg-[#FBEBEF]'
            );

        });

    });


    dropZone.addEventListener('drop', function (event) {

        const files = Array.from(
            event.dataTransfer.files
        );

        if (files.length) {

            fileInput.files =
                event.dataTransfer.files;

            handleFiles(files);
        }

    });


    /*
    |--------------------------------------------------------------------------
    | Handle Files
    |--------------------------------------------------------------------------
    */

    function handleFiles(files) {

        if (!files.length) {

            resetPreview();

            return;
        }


        if (files.length > 30) {

            alert(
                'You can upload a maximum of 30 images at once.'
            );

            fileInput.value = '';

            resetPreview();

            return;
        }


        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];


        const invalidFile = files.some(function (file) {

            return !allowedTypes.includes(file.type);

        });


        if (invalidFile) {

            alert(
                'Only JPG, JPEG, PNG and WEBP images are allowed.'
            );

            fileInput.value = '';

            resetPreview();

            return;
        }


        const oversizedFile = files.some(function (file) {

            return file.size > 5 * 1024 * 1024;

        });


        if (oversizedFile) {

            alert(
                'Each image must be 5 MB or smaller.'
            );

            fileInput.value = '';

            resetPreview();

            return;
        }


        renderPreviews(files);
    }


    /*
    |--------------------------------------------------------------------------
    | Render Previews
    |--------------------------------------------------------------------------
    */

    function renderPreviews(files) {

        previewGrid.innerHTML = '';


        files.forEach(function (file) {

            const reader =
                new FileReader();


            reader.onload = function (event) {

                const wrapper =
                    document.createElement('div');

                wrapper.className =
                    'group relative aspect-square overflow-hidden rounded-xl bg-gray-100 ring-1 ring-gray-200';


                const image =
                    document.createElement('img');

                image.src =
                    event.target.result;

                image.alt =
                    file.name;

                image.className =
                    'h-full w-full object-cover transition duration-300 group-hover:scale-105';


                const overlay =
                    document.createElement('div');

                overlay.className =
                    'absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-2 pt-8';


                const name =
                    document.createElement('p');

                name.className =
                    'truncate text-[10px] font-medium text-white';

                name.textContent =
                    file.name;


                overlay.appendChild(name);

                wrapper.appendChild(image);

                wrapper.appendChild(overlay);

                previewGrid.appendChild(wrapper);

            };


            reader.readAsDataURL(file);

        });


        placeholder.classList.add('hidden');

        previewContainer.classList.remove('hidden');

        imageCount.textContent =
            files.length +
            (files.length === 1
                ? ' image selected'
                : ' images selected');

        uploadButton.disabled = false;
    }


    /*
    |--------------------------------------------------------------------------
    | Reset
    |--------------------------------------------------------------------------
    */

    function resetPreview() {

        placeholder.classList.remove('hidden');

        previewContainer.classList.add('hidden');

        previewGrid.innerHTML = '';

        imageCount.textContent =
            '0 images selected';

        uploadButton.disabled = true;
    }


    /*
    |--------------------------------------------------------------------------
    | Description Counter
    |--------------------------------------------------------------------------
    */

    function updateDescriptionCount() {

        descriptionCount.textContent =
            description.value.length;

    }


    description.addEventListener(
        'input',
        updateDescriptionCount
    );

    updateDescriptionCount();


    /*
    |--------------------------------------------------------------------------
    | Submit
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('galleryUploadForm')
        .addEventListener('submit', function () {

            uploadButton.disabled = true;

            uploadButton.innerHTML = `
                <svg
                    class="h-4 w-4 animate-spin"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                        stroke="currentColor"
                        stroke-width="2"
                        class="opacity-25"
                    ></circle>

                    <path
                        d="M4 12a8 8 0 018-8"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                    ></path>
                </svg>

                Uploading...
            `;

        });

});


/*
|--------------------------------------------------------------------------
| Admin Vendor Switching
|--------------------------------------------------------------------------
*/

function changeVendor(vendorId)
{
    if (!vendorId) {
        return;
    }

    const url =
        "{{ route('vendors.images.create') }}" +
        "?vendor=" +
        encodeURIComponent(vendorId);

    window.location.href = url;
}

</script>

@endpush

@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VendorImageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Gallery Index
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $isAdmin = $this->isSuperAdmin();

        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        |
        | Super admin can select and manage any vendor's gallery.
        |
        */

        if ($isAdmin) {

            $vendors = Vendor::query()
                ->with('city')
                ->orderBy('business_name')
                ->get();

            $vendor = null;
            $images = null;

            if ($request->filled('vendor')) {

                $vendor = $this->getVendor($request);

                $images = $vendor->images()
                    ->orderBy('sort_order')
                    ->paginate(24)
                    ->withQueryString();
            }

            return view('vendors.images.index', [
                'vendor' => $vendor,
                'vendors' => $vendors,
                'images' => $images,
                'isAdmin' => true,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Vendor
        |--------------------------------------------------------------------------
        */

        $vendor = $this->getVendor($request);

        $images = $vendor->images()
            ->orderBy('sort_order')
            ->paginate(24)
            ->withQueryString();

        return view('vendors.images.index', [
            'vendor' => $vendor,
            'vendors' => collect(),
            'images' => $images,
            'isAdmin' => false,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create(Request $request): View
    {
        $isAdmin = $this->isSuperAdmin();

        $vendor = $this->getVendor($request);

        $vendors = collect();

        /*
        |--------------------------------------------------------------------------
        | Super Admin Gets Vendor List
        |--------------------------------------------------------------------------
        */

        if ($isAdmin) {

            $vendors = Vendor::query()
                ->with('city')
                ->orderBy('business_name')
                ->get();
        }

        return view('vendors.images.create', [
            'vendor' => $vendor,
            'vendors' => $vendors,
            'isAdmin' => $isAdmin,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Store / Bulk Upload
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $vendor = $this->getVendor($request);

        $validated = $request->validate([
            'images' => [
                'required',
                'array',
                'min:1',
                'max:30',
            ],

            'images.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Determine Next Sort Order
        |--------------------------------------------------------------------------
        */

        $nextSortOrder =
            ((int) $vendor->images()->max('sort_order')) + 1;


        /*
        |--------------------------------------------------------------------------
        | Store Images
        |--------------------------------------------------------------------------
        */

        foreach ($validated['images'] as $uploadedImage) {

            $path = $uploadedImage->store(
                "vendor-images/{$vendor->id}",
                'public'
            );

            VendorImage::create([
                'vendor_id' => $vendor->id,
                'image_url' => $path,
                'title' => $validated['title'] ?? null,
                'description' => $validated['description'] ?? null,
                'sort_order' => $nextSortOrder++,
                'status' => 'active',
            ]);
        }


        return redirect()
            ->route('vendors.images.index', [
                'vendor' => $vendor->id,
            ])
            ->with(
                'success',
                'Gallery images uploaded successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    |
    | There is intentionally NO vendors.images.show Blade view.
    |
    | Images are previewed directly on the gallery page using the
    | same-page modal. If the show URL is accessed directly, redirect
    | back to the vendor gallery.
    |
    */

    public function show(
        Request $request,
        VendorImage $image
    ): RedirectResponse {

        $vendor = $this->getVendor($request);

        $this->ensureImageBelongsToVendor($image, $vendor);

        return redirect()
            ->route('vendors.images.index', [
                'vendor' => $vendor->id,
            ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(
        Request $request,
        VendorImage $image
    ): View {

        $vendor = $this->getVendor($request);

        $this->ensureImageBelongsToVendor($image, $vendor);

        $vendors = collect();

        /*
        |--------------------------------------------------------------------------
        | Super Admin Gets Vendor List
        |--------------------------------------------------------------------------
        */

        if ($this->isSuperAdmin()) {

            $vendors = Vendor::query()
                ->with('city')
                ->orderBy('business_name')
                ->get();
        }

        return view('vendors.images.edit', [
            'vendor' => $vendor,
            'image' => $image,
            'vendors' => $vendors,
            'isAdmin' => $this->isSuperAdmin(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        VendorImage $image
    ): RedirectResponse {

        $vendor = $this->getVendor($request);

        $this->ensureImageBelongsToVendor($image, $vendor);

        $validated = $request->validate([
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $image->image_url &&
                Storage::disk('public')->exists(
                    $image->image_url
                )
            ) {
                Storage::disk('public')->delete(
                    $image->image_url
                );
            }

            $image->image_url = $request
                ->file('image')
                ->store(
                    "vendor-images/{$vendor->id}",
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Update Metadata
        |--------------------------------------------------------------------------
        */

        $image->title =
            $validated['title'] ?? null;

        $image->description =
            $validated['description'] ?? null;

        $image->sort_order =
            $validated['sort_order'];

        $image->status =
            $validated['status'];

        $image->save();


        return redirect()
            ->route('vendors.images.index', [
                'vendor' => $vendor->id,
            ])
            ->with(
                'success',
                'Gallery image updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Request $request,
        VendorImage $image
    ): RedirectResponse {

        $vendor = $this->getVendor($request);

        $this->ensureImageBelongsToVendor($image, $vendor);


        /*
        |--------------------------------------------------------------------------
        | Delete Physical File
        |--------------------------------------------------------------------------
        */

        if (
            $image->image_url &&
            Storage::disk('public')->exists(
                $image->image_url
            )
        ) {
            Storage::disk('public')->delete(
                $image->image_url
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Database Record
        |--------------------------------------------------------------------------
        */

        $image->delete();


        return redirect()
            ->route('vendors.images.index', [
                'vendor' => $vendor->id,
            ])
            ->with(
                'success',
                'Gallery image deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Reorder
    |--------------------------------------------------------------------------
    */

    public function reorder(Request $request): RedirectResponse
    {
        $vendor = $this->getVendor($request);

        $validated = $request->validate([
            'images' => [
                'required',
                'array',
            ],

            'images.*.id' => [
                'required',
                'integer',
            ],

            'images.*.sort_order' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);


        foreach ($validated['images'] as $item) {

            VendorImage::query()
                ->where('id', $item['id'])
                ->where('vendor_id', $vendor->id)
                ->update([
                    'sort_order' => $item['sort_order'],
                ]);
        }


        return redirect()
            ->route('vendors.images.index', [
                'vendor' => $vendor->id,
            ])
            ->with(
                'success',
                'Gallery order updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Get Vendor
    |--------------------------------------------------------------------------
    |
    | Super Admin:
    |     Can access any vendor.
    |
    | Vendor:
    |     Can access only vendors where user_id = Auth::id().
    |
    */

    private function getVendor(Request $request): Vendor
    {
        $vendorId = $request->query('vendor');


        /*
        |--------------------------------------------------------------------------
        | Vendor ID Required
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $vendorId &&
            is_numeric($vendorId),
            404
        );


        /*
        |--------------------------------------------------------------------------
        | Super Admin
        |--------------------------------------------------------------------------
        */

        if ($this->isSuperAdmin()) {

            $vendor = Vendor::query()
                ->where('id', (int) $vendorId)
                ->first();

            abort_unless($vendor, 404);

            return $vendor;
        }


        /*
        |--------------------------------------------------------------------------
        | Normal Vendor
        |--------------------------------------------------------------------------
        */

        $vendor = Vendor::query()
            ->where('id', (int) $vendorId)
            ->where('user_id', Auth::id())
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Prevent Access To Another Vendor
        |--------------------------------------------------------------------------
        */

        abort_unless($vendor, 403);

        return $vendor;
    }


    /*
    |--------------------------------------------------------------------------
    | Ensure Image Belongs To Vendor
    |--------------------------------------------------------------------------
    */

    private function ensureImageBelongsToVendor(
        VendorImage $image,
        Vendor $vendor
    ): void {

        abort_unless(
            (int) $image->vendor_id === (int) $vendor->id,
            403
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Super Admin Check
    |--------------------------------------------------------------------------
    */

    private function isSuperAdmin(): bool
    {
        return Auth::check()
            && in_array(
                Auth::user()->role,
                [
                    'superadmin',
                    'super_admin',
                ],
                true
            );
    }
}
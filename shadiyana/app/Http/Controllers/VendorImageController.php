<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class VendorImageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Image Statuses
    |--------------------------------------------------------------------------
    */

    private const STATUSES = [
        'active',
        'inactive',
    ];


    /*
    |--------------------------------------------------------------------------
    | Display Vendor Images
    |--------------------------------------------------------------------------
    |
    | Display all gallery images belonging to a specific vendor.
    |
    */

    public function index(Vendor $vendor): View
    {
        $images = $vendor->images()
            ->latest('sort_order')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view(
            'vendor-images.index',
            compact(
                'vendor',
                'images'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Create Image Form
    |--------------------------------------------------------------------------
    */

    public function create(Vendor $vendor): View
    {
        return view(
            'vendor-images.create',
            compact('vendor')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Vendor Image
    |--------------------------------------------------------------------------
    |
    | Upload a new gallery image for the selected vendor.
    |
    */

    public function store(
        Request $request,
        Vendor $vendor
    ): RedirectResponse {

        $validated = $this->validateImage($request);


        /*
        |--------------------------------------------------------------------------
        | Determine Sort Order
        |--------------------------------------------------------------------------
        |
        | If the administrator does not provide a sort order,
        | automatically place the image at the end of the gallery.
        |
        */

        $sortOrder = $validated['sort_order']
            ?? $this->getNextSortOrder($vendor);


        /*
        |--------------------------------------------------------------------------
        | Store Image
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        try {

            $imagePath = $request
                ->file('image')
                ->store(
                    'vendors/gallery',
                    'public'
                );


            /*
            |--------------------------------------------------------------------------
            | Create Database Record
            |--------------------------------------------------------------------------
            */

            VendorImage::create([

                'vendor_id' =>
                    $vendor->id,

                'image_url' =>
                    $imagePath,

                'title' =>
                    $validated['title'] ?? null,

                'description' =>
                    $validated['description'] ?? null,

                'sort_order' =>
                    $sortOrder,

                'status' =>
                    $validated['status'],
            ]);


        } catch (Throwable $exception) {

            /*
            |--------------------------------------------------------------------------
            | Cleanup Uploaded File
            |--------------------------------------------------------------------------
            |
            | If database insertion fails after the file has been uploaded,
            | remove the orphaned file.
            |
            */

            if (
                $imagePath &&
                Storage::disk('public')->exists($imagePath)
            ) {

                Storage::disk('public')->delete(
                    $imagePath
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Report Error
            |--------------------------------------------------------------------------
            */

            report($exception);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'image' =>
                        'The image could not be uploaded. Please try again.',
                ]);
        }


        return redirect()
            ->route(
                'vendors.show',
                $vendor
            )
            ->with(
                'success',
                'Vendor gallery image added successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Edit Image Form
    |--------------------------------------------------------------------------
    */

    public function edit(
        Vendor $vendor,
        VendorImage $image
    ): View {

        $this->ensureImageBelongsToVendor(
            $vendor,
            $image
        );

        return view(
            'vendor-images.edit',
            compact(
                'vendor',
                'image'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Vendor Image
    |--------------------------------------------------------------------------
    |
    | Update image information and optionally replace the image file.
    |
    */

    public function update(
        Request $request,
        Vendor $vendor,
        VendorImage $image
    ): RedirectResponse {

        $this->ensureImageBelongsToVendor(
            $vendor,
            $image
        );


        $validated = $this->validateImage(
            $request,
            false
        );


        /*
        |--------------------------------------------------------------------------
        | Existing Image Path
        |--------------------------------------------------------------------------
        */

        $oldImagePath = $image->image_url;

        $newImagePath = null;


        try {

            /*
            |--------------------------------------------------------------------------
            | Replace Physical Image
            |--------------------------------------------------------------------------
            |
            | Upload the new image first.
            |
            */

            if ($request->hasFile('image')) {

                $newImagePath = $request
                    ->file('image')
                    ->store(
                        'vendors/gallery',
                        'public'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | Update Database
            |--------------------------------------------------------------------------
            */

            DB::transaction(function () use (
                $image,
                $validated,
                $newImagePath
            ) {

                $image->update([

                    'image_url' =>
                        $newImagePath
                            ?? $image->image_url,

                    'title' =>
                        $validated['title'] ?? null,

                    'description' =>
                        $validated['description'] ?? null,

                    'sort_order' =>
                        $validated['sort_order'],

                    'status' =>
                        $validated['status'],
                ]);
            });


            /*
            |--------------------------------------------------------------------------
            | Delete Old Physical Image
            |--------------------------------------------------------------------------
            |
            | Only delete the old image after the database update succeeds.
            |
            */

            if (
                $newImagePath &&
                $oldImagePath &&
                Storage::disk('public')
                    ->exists($oldImagePath)
            ) {

                Storage::disk('public')
                    ->delete($oldImagePath);
            }


        } catch (Throwable $exception) {

            /*
            |--------------------------------------------------------------------------
            | Cleanup New Image If Update Failed
            |--------------------------------------------------------------------------
            */

            if (
                $newImagePath &&
                Storage::disk('public')
                    ->exists($newImagePath)
            ) {

                Storage::disk('public')
                    ->delete($newImagePath);
            }


            report($exception);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'image' =>
                        'The gallery image could not be updated. Please try again.',
                ]);
        }


        return redirect()
            ->route(
                'vendors.show',
                $vendor
            )
            ->with(
                'success',
                'Vendor gallery image updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Vendor Image
    |--------------------------------------------------------------------------
    |
    | Delete both the database record and the physical image.
    |
    */

    public function destroy(
        Vendor $vendor,
        VendorImage $image
    ): RedirectResponse {

        $this->ensureImageBelongsToVendor(
            $vendor,
            $image
        );


        /*
        |--------------------------------------------------------------------------
        | Store Image Path Before Deletion
        |--------------------------------------------------------------------------
        */

        $imagePath = $image->image_url;


        try {

            /*
            |--------------------------------------------------------------------------
            | Delete Database Record
            |--------------------------------------------------------------------------
            */

            DB::transaction(function () use ($image) {

                $image->delete();
            });


            /*
            |--------------------------------------------------------------------------
            | Delete Physical Image
            |--------------------------------------------------------------------------
            */

            if (
                $imagePath &&
                Storage::disk('public')
                    ->exists($imagePath)
            ) {

                Storage::disk('public')
                    ->delete($imagePath);
            }


        } catch (Throwable $exception) {

            report($exception);

            return redirect()
                ->back()
                ->withErrors([
                    'image' =>
                        'The gallery image could not be deleted. Please try again.',
                ]);
        }


        return redirect()
            ->route(
                'vendors.show',
                $vendor
            )
            ->with(
                'success',
                'Vendor gallery image deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Toggle Image Status
    |--------------------------------------------------------------------------
    |
    | Switch between:
    |
    | active
    | inactive
    |
    */

    public function toggleStatus(
        Vendor $vendor,
        VendorImage $image
    ): RedirectResponse {

        $this->ensureImageBelongsToVendor(
            $vendor,
            $image
        );


        $newStatus = $image->status === 'active'
            ? 'inactive'
            : 'active';


        $image->update([
            'status' => $newStatus,
        ]);


        return redirect()
            ->back()
            ->with(
                'success',
                'Gallery image status updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Sort Order
    |--------------------------------------------------------------------------
    |
    | Allows administrators to manually control gallery ordering.
    |
    */

    public function updateSortOrder(
        Request $request,
        Vendor $vendor,
        VendorImage $image
    ): RedirectResponse {

        $this->ensureImageBelongsToVendor(
            $vendor,
            $image
        );


        $validated = $request->validate([

            'sort_order' => [
                'required',
                'integer',
                'min:0',
                'max:2147483647',
            ],

        ]);


        $image->update([
            'sort_order' =>
                $validated['sort_order'],
        ]);


        return redirect()
            ->back()
            ->with(
                'success',
                'Gallery image order updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    private function validateImage(
        Request $request,
        bool $imageRequired = true
    ): array {

        return $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Image
            |--------------------------------------------------------------------------
            */

            'image' => [
                $imageRequired
                    ? 'required'
                    : 'nullable',

                'image',

                'mimes:jpg,jpeg,png,webp',

                'max:4096',
            ],


            /*
            |--------------------------------------------------------------------------
            | Title
            |--------------------------------------------------------------------------
            */

            'title' => [
                'nullable',
                'string',
                'max:255',
            ],


            /*
            |--------------------------------------------------------------------------
            | Description
            |--------------------------------------------------------------------------
            */

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],


            /*
            |--------------------------------------------------------------------------
            | Sort Order
            |--------------------------------------------------------------------------
            */

            'sort_order' => [
                $imageRequired
                    ? 'nullable'
                    : 'required',

                'integer',
                'min:0',
                'max:2147483647',
            ],


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                Rule::in(
                    self::STATUSES
                ),
            ],
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Get Next Sort Order
    |--------------------------------------------------------------------------
    |
    | Example:
    |
    | Existing:
    | 0
    | 1
    | 2
    |
    | New image:
    | 3
    |
    */

    private function getNextSortOrder(
        Vendor $vendor
    ): int {

        $maxSortOrder = VendorImage::query()
            ->where(
                'vendor_id',
                $vendor->id
            )
            ->max('sort_order');


        return $maxSortOrder === null
            ? 0
            : ((int) $maxSortOrder + 1);
    }


    /*
    |--------------------------------------------------------------------------
    | Verify Image Belongs To Vendor
    |--------------------------------------------------------------------------
    |
    | Prevent an administrator from accidentally or maliciously operating
    | on an image belonging to another vendor.
    |
    */

    private function ensureImageBelongsToVendor(
        Vendor $vendor,
        VendorImage $image
    ): void {

        abort_unless(
            (int) $image->vendor_id === (int) $vendor->id,
            404
        );
    }
}
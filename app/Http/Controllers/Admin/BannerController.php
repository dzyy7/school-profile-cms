<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banners;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banners::orderBy('order', 'asc')->get();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|min:2|max:255',
            'sub_title'    => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB Max
        ]);

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('banners-images', 'public');
        }

        $lastOrder = Banners::max('order') ?? 0;

        Banners::create([
            'title'      => $validated['title'],
            'sub_title'    => $validated['sub_title'],
            'image_path' => $imagePath,
            'order'      => $lastOrder + 1,
            'is_active'  => true,
        ]);

        return redirect('/banners')->with('success', 'Banner baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banners $banner)
    {
        return view ('admin.banners.edit', ['banners' => $banner]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banners $banner)
    {
        $validatedData = $request->validate([
            'title' => [
                'required', 'min:2', 'max:255',
                Rule::unique('banners')->ignore($banner->id),
            ],
            'sub_title'    => 'required|min:4|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $imagePath = $banner->image_path;
        if ($request->hasFile('image_path')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $imagePath = $request->file('image_path')->store('banner-images', 'public');
        }
        $banner->update([
            'title'      => $validatedData['title'],
            'sub_title'    => $validatedData['sub_title'],
            'image_path' => $imagePath,
        ]);

        return redirect('/banners')->with('success', 'Banner berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banners $banner)
    {
        if ($banner->image_path) {
        Storage::disk('public')->delete($banner->image_path);
        }
        $banner->delete();
        return redirect('/banners')->with('success', 'Banner berhasil dihapus!');
    }

    public function toggleActive($id)
    {
        $banner = Banners::findOrFail($id);
        $banner->update(['is_active' => !$banner->is_active]);

        $status = $banner->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Banner berhasil $status!");
    }

    public function moveUp($id)
    {
        $currentBanner = Banners::findOrFail($id);

        // Cari banner di urutan sebelumnya
        $previousBanner = Banners::where('order', '<', $currentBanner->order)
                                 ->orderBy('order', 'desc')
                                 ->first();

        if ($previousBanner) {
            // Tukar posisi order
            $tempOrder = $currentBanner->order;
            $currentBanner->update(['order' => $previousBanner->order]);
            $previousBanner->update(['order' => $tempOrder]);
        }

        return back()->with('success', 'Urutan banner berhasil dinaikkan!');
    }

    public function moveDown($id)
    {
        $currentBanner = Banners::findOrFail($id);

        // Cari banner di urutan setelahnya
        $nextBanner = Banners::where('order', '>', $currentBanner->order)
                             ->orderBy('order', 'asc')
                             ->first();

        if ($nextBanner) {
            // Tukar posisi order
            $tempOrder = $currentBanner->order;
            $currentBanner->update(['order' => $nextBanner->order]);
            $nextBanner->update(['order' => $tempOrder]);
        }

        return back()->with('success', 'Urutan banner berhasil diturunkan!');
    }
}
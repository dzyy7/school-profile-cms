<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Teacher::query();

        // Logic pencarian sederhana
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('jabatan', 'LIKE', "%{$search}%");
        }

        $teachers = $query->latest()->paginate(8);

        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|min:2|max:255',
            'jabatan'    => 'required|min:4|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB Max
        ]);
        $imagePath = null;

        // 2. Upload Logic (Direct Upload)
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('teacher-images', 'public');
        }

        Teacher::create([
            'name'      => $validated['name'],
            'jabatan'    => $validated['jabatan'],
            'image_path' => $imagePath,
        ]);

           return redirect('/teachers')->with('success', 'Guru baru berhasil ditambahkan!');
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
    public function edit(Teacher $teacher)
    {
        return view ('admin.teachers.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validatedData = $request->validate([
            'name' => [
                'required', 'min:2', 'max:255',
                Rule::unique('teachers')->ignore($teacher->id),
            ],
            'jabatan'    => 'required|min:4|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $imagePath = $teacher->image_path;

        // Logika update Featured Image (tetap sama seperti punyamu)
        if ($request->hasFile('image_path')) {
            if ($teacher->image_path) {
                Storage::disk('public')->delete($teacher->image_path);
            }
            $imagePath = $request->file('image_path')->store('posts-images', 'public');
        }
        $teacher->update([
            'name'      => $validatedData['name'],
            'jabatan'    => $validatedData['jabatan'],
            'image_path' => $imagePath,
        ]);

        return redirect('/teachers')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        if ($teacher->image_path) {
        Storage::disk('public')->delete($teacher->image_path);
        }

        $teacher->delete();

        return redirect('/teachers')->with('success', 'Data guru dan foto berhasil dihapus!');
    }
}
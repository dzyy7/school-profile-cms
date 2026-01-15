<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::query()
        ->when(request('keyword'), function ($query, $keyword) {
            return $query->where('title', 'ILIKE', '%' . $keyword . '%');
        })
        ->latest()
        ->paginate(10)
        ->withQueryString(); // Sangat penting agar pagination tidak hilang saat search

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'title'      => 'required|unique:posts|min:4|max:255',
            'content'    => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB Max
            'status'     => 'required|in:draft,published',
        ]);

        $imagePath = null;

        // 2. Upload Logic (Direct Upload)
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('posts-images', 'public');
        }

        // 3. Simpan ke Database
        Post::create([
            'title'      => $validated['title'],
            'slug'       => Str::slug($validated['title']),
            'author_id'  => Auth::id(),
            'content'    => $validated['content'],
            'status'     => $validated['status'],
            'image_path' => $imagePath,
        ]);

            return redirect('/posts')->with('success', 'New post has been added!');
    }

    public function uploadBodyImage(Request $request){
        if ($request->hasFile('upload')) { // CKEditor default mengirim file dengan name 'upload'
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $path = $request->file('upload')->store('content-images', 'public'); // Folder ganti biar rapi

            // PENTING: CKEditor 5 butuh return JSON format ini:
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => ['message' => 'Gagal upload gambar']], 400);
    }

    private function extractContentImages($content)
    {
        // Regex ini mencari src di dalam tag img.
        // CKEditor output: <img src="..."> atau <figure class="image"><img src="..."></figure>
        preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);

        $images = [];

        foreach ($matches[1] as $url) {
            // Sesuaikan dengan folder penyimpanan baru jika diubah ('content-images')
            if (str_contains($url, 'storage/content-images')) {
                $path = Str::after($url, 'storage/');
                $images[] = $path;
            }
        }

        return $images;
    }

    private function deleteContentImages(array $images)
    {
        foreach ($images as $image) {
            if (Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', ['post' => $post]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit',  ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => [
                'required', 'min:4', 'max:255',
                Rule::unique('posts')->ignore($post->id),
            ],
            'content'    => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $oldImages = $this->extractContentImages($post->content);
        $newImages = $this->extractContentImages($request->content);
        $deletedImages = array_diff($oldImages, $newImages);
        $this->deleteContentImages($deletedImages);

        $status = $request->has('status') ? 'published' : 'draft';
        $imagePath = $post->image_path;

        // Logika update Featured Image (tetap sama seperti punyamu)
        if ($request->hasFile('image_path')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $imagePath = $request->file('image_path')->store('posts-images', 'public');
        }

        $post->update([
            'title'      => $validatedData['title'],
            'slug'       => Str::slug($validatedData['title']),
            'content'    => $validatedData['content'],
            'status'     => $status,
            'image_path' => $imagePath,
        ]);

        return redirect('/posts')->with('success', 'Berita berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // 1. Hapus Featured Image (Gambar Utama)
        if ($post->image_path && Storage::disk('public')->exists($post->image_path)) {
            Storage::disk('public')->delete($post->image_path);
        }

        // 2. Hapus Semua Gambar di dalam Konten Trix
       $contentImages = $this->extractContentImages($post->content);
        $this->deleteContentImages($contentImages);
        // 3. Hapus data dari database
        $post->delete();

        return redirect('/posts')->with('success', 'Post has been deleted!');
    }
}

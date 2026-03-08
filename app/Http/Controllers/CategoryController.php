<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller {
    public function __construct() {
        //
    }

    public function index() {
        $categories = Category::latest()->paginate(5);
        return inertia('Authenticated/ContentManagement/Category/Index', [
            'categories' => $categories
        ]);
    }

    public function create() {
        return inertia('Authenticated/ContentManagement/Category/Create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255|unique:categories,slug',
        ], [
            'name.required' => 'Nama Kategori Wajib Diisi!',
            'name.unique'   => 'Nama Kategori Sudah Ada!',
            'slug.unique'   => 'Slug Sudah Digunakan.',
        ]);

        try {
            Category::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['slug']),
            ]);

            return redirect()->route('admin.kategori.index')->with([
                'toast'   => true,
                'icon'    => 'success',
                'message' => 'Kategori baru berhasil ditambahkan!'
            ]);
        } catch (Exception $e) {
            Log::error("Gagal simpan kategori: " . $e->getMessage());

            return redirect()->back()->withInput()->with([
                'toast'   => false,
                'icon'    => 'error',
                'title'   => 'Gagal!',
                'message' => 'Terjadi kesalahan saat menyimpan data!'
            ]);
        }
    }

    public function show(Category $category) {
        return inertia('Authenticated/ContentManagement/Category/Show', [
            'category' => $category
        ]);
    }

    public function edit(Category $category) {
        //
    }

    public function update(Request $request, Category $category) {
        //
    }

    public function destroy(Category $category) {
        try {
            $category->delete();

            return redirect()->back()->with([
                'toast' => true,
                'icon' => 'success',
                'message' => 'Kategori berhasil dihapus!'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with([
                'toast' => true,
                'icon' => 'error',
                'message' => 'Gagal menghapus kategori. Data mungkin sedang digunakan.'
            ]);
        }
    }
}

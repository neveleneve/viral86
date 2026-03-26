<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use League\Config\Exception\ValidationException;

class CategoryController extends Controller {
    public function __construct() {
        $this->middleware('permission:edit-kategori')->only('update');
        $this->middleware('permission:view-kategori')->only('index');
        $this->middleware('permission:create-kategori')->only('create', 'store');
        $this->middleware('permission:delete-kategori')->only('destroy');
    }

    public function index(Request $request) {
        try {
            $search = $request->search;

            $categories = Category::query()
                ->when($search, function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(5)
                ->withQueryString();
            return inertia('Authenticated/ContentManagement/Category/Index', [
                'categories' => $categories,
                'filters' => $request->only(['search'])
            ]);
        } catch (Exception $e) {
            Log::error("Gagal memuat data kategori: " . $e->getMessage());
            return back()
                ->with([
                    'toast'   => false,
                    'icon'    => 'error',
                    'title'   => 'Gagal!',
                    'message' => 'Terjadi kesalahan saat mengambil data!' . $e->getMessage()
                ]);
        }
    }

    public function create() {
        $categories = Category::get();
        return inertia('Authenticated/ContentManagement/Category/Create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'name'          => ['required', 'string', 'max:255', 'unique:categories,name'],
                'slug'          => ['required', 'string', 'max:255', 'unique:categories,slug'],
                'description'   => ['nullable', 'string', 'max:500'],
                'parent_id'     => ['nullable', 'integer', 'exists:categories,id'],
                'color'         => ['nullable', 'regex:/^#([a-f0-9]{6})$/i'],
            ], [
                'name.required'     => 'Nama kategori jangan dikosongin!',
                'name.unique'       => 'Nama kategori ini udah dipake!',

                'slug.required'     => 'Slug kategori jangan dikosongin!',
                'slug.unique'       => 'Slug kategori ini udah dipake!',

                'color.regex'       => 'Format warna harus HEX yang bener (contoh: #B91C1C).',

                'description.max'   => 'Deskripsinya kepanjangan!',
            ]);
            $create = Category::create([
                'name'          => $validated['name'],
                'slug'          => Str::slug($validated['slug']),
                'description'   => $validated['description'] ?? null,
                'parent_id'     => $validated['parent_id'] ?? null,
                'color'         => $validated['color'] ?? '#b91c1c',
            ]);

            if ($create) {
                return redirect()
                    ->back()
                    ->with([
                        'toast'     => true,
                        'icon'      => 'success',
                        'message'   => 'Kategori baru berhasil ditambahkan!'
                    ]);
            } else {
                throw new Exception('Gagal menambahkan data kategori!');
            }
        } catch (Exception $e) {
            Log::error("Gagal simpan kategori: " . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'toast'     => false,
                    'icon'      => 'error',
                    'title'     => 'Gagal!',
                    'message'   => 'Terjadi kesalahan saat menyimpan data! ' . $e->getMessage()
                ]);
        }
    }

    public function show(Category $kategori) {
        $categories = Category::get();
        return inertia('Authenticated/ContentManagement/Category/Show', [
            'category'      => $kategori,
            'categories'    => $categories
        ]);
    }

    public function update(Request $request, Category $kategori) {

        try {
            $validated = $request->validate([
                'name'          => ['required', 'string', 'max:255', 'unique:categories,name,' . $kategori->id],
                'slug'          => ['required', 'string', 'max:255', 'unique:categories,slug,' . $kategori->id],
                'description'   => ['nullable', 'string', 'max:500'],
                'parent_id'     => ['nullable', 'integer', 'exists:categories,id'],
                'color'         => ['nullable', 'regex:/^#([a-f0-9]{6})$/i'],
            ], [
                'name.required'     => 'Nama kategori jangan dikosongin!',
                'name.unique'       => 'Nama kategori ini udah dipake!',

                'slug.required'     => 'Slug kategori jangan dikosongin!',
                'slug.unique'       => 'Slug kategori ini udah dipake!',

                'color.regex'       => 'Format warna harus HEX yang bener (contoh: #B91C1C).',

                'description.max'   => 'Deskripsinya kepanjangan!',
            ]);

            $kategori->update($validated);

            return redirect()
                ->back()
                ->with([
                    'toast'   => true,
                    'icon'    => 'success',
                    'message' => 'Kategori berhasil diubah!'
                ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            Log::error("Gagal update kategori: " . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'toast'   => false,
                    'icon'    => 'error',
                    'title'   => 'Gagal!',
                    'message' => 'Terjadi kesalahan saat mengupdate data!' . $e->getMessage()
                ]);
        }
    }

    public function destroy(Category $kategori) {
        try {
            $delete = $kategori->delete();
            if ($delete) {
                return redirect()
                    ->back()
                    ->with([
                        'toast' => true,
                        'icon' => 'success',
                        'message' => 'Kategori berhasil dihapus!'
                    ]);
            } else {
                return redirect()
                    ->back()
                    ->with([
                        'toast' => true,
                        'icon' => 'warning',
                        'message' => 'Kategori gagal dihapus!'
                    ]);
            }
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with([
                    'toast' => true,
                    'icon' => 'error',
                    'message' => 'Gagal menghapus kategori. Data mungkin sedang digunakan.'
                ]);
        }
    }
}

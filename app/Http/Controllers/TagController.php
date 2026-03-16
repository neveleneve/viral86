<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use League\Config\Exception\ValidationException;

class TagController extends Controller {
    public function __construct() {
        $this->middleware('permission:edit-tag')->only('update');
        $this->middleware('permission:view-tag')->only('index');
        $this->middleware('permission:create-tag')->only('create', 'store');
        $this->middleware('permission:delete-tag')->only('destroy');
    }

    public function index(Request $request) {
        try {
            $search = $request->search;

            $tags = Tag::query()
                ->when($search, function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();

            return inertia('Authenticated/ContentManagement/Tag/Index', [
                'tags'      => $tags,
                'filters'   => $request->only(['search'])
            ]);
        } catch (Exception $e) {
            Log::error("Gagal memuat data tag: " . $e->getMessage());
            return back()
                ->with([
                    'toast'     => false,
                    'icon'      => 'error',
                    'title'     => 'Gagal!',
                    'message'   => 'Terjadi kesalahan saat mengambil data!' . $e->getMessage()
                ]);
        }
    }

    public function create() {
        return inertia('Authenticated/ContentManagement/Tag/Create');
    }

    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:tags,name']
            ], [
                'name.required' => 'Nama kategori wajib diisi!',
                'name.unique' => 'Nama kategori sudah ada!',
            ]);
            Tag::create([
                'name' => $validated['name']
            ]);

            return redirect()
                ->back()
                ->with([
                    'toast'   => true,
                    'icon'    => 'success',
                    'message' => 'Tag baru berhasil ditambahkan!'
                ]);
        } catch (Exception $e) {
            Log::error("Gagal simpan tag: " . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'toast'   => false,
                    'icon'    => 'error',
                    'title'   => 'Gagal!',
                    'message' => 'Terjadi kesalahan saat menyimpan data! ' . $e->getMessage()
                ]);
        }
    }

    public function show(Tag $tag) {
        return inertia('Authenticated/ContentManagement/Tag/Show', [
            'tag' => $tag
        ]);
    }

    public function update(Request $request, Tag $tag) {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:tags,name']
            ], [
                'name.required' => 'Nama tag wajib diisi!',
                'name.unique'   => 'Nama tag sudah ada!',
            ]);

            $tag->update($validated);

            return redirect()
                ->back()
                ->with([
                    'toast'     => true,
                    'icon'      => 'success',
                    'message'   => 'Tag berhasil diubah!'
                ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            Log::error("Gagal update tag: " . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'toast'     => false,
                    'icon'      => 'error',
                    'title'     => 'Gagal!',
                    'message'   => 'Terjadi kesalahan saat mengupdate data!' . $e->getMessage()
                ]);
        }
    }

    public function destroy(Tag $tag) {
        try {
            $delete = $tag->delete();
            if ($delete) {
                return redirect()
                    ->back()
                    ->with([
                        'toast' => true,
                        'icon' => 'success',
                        'message' => 'Tag berhasil dihapus!'
                    ]);
            }
            return redirect()
                ->back()
                ->with([
                    'toast'     => true,
                    'icon'      => 'warning',
                    'message'   => 'Tag gagal dihapus!'
                ]);
        } catch (Exception $e) {
            Log::error("Gagal hapus tag: " . $e->getMessage());

            return redirect()
                ->back()
                ->with([
                    'toast'     => false,
                    'icon'      => 'error',
                    'title'     => 'Gagal!',
                    'message'   => 'Gagal menghapus data!' . $e->getMessage()
                ]);
        }
    }
}

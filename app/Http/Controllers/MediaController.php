<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller {
    public function __construct() {
        $this->middleware('permission:view-media')->only('index');
        $this->middleware('permission:upload-media')->only('create', 'store');
        $this->middleware('permission:delete-media')->only('destroy');
    }

    public function index(Request $request) {
        try {
            $search = $request->search;

            $media = Media::query()
                ->when($search, function ($q) use ($search) {
                    $q->where('caption', 'like', "%{$search}%")
                        ->orWhere('source', 'like', "%{$search}%");
                })
                ->latest()
                ->paginate(5)
                ->withQueryString();

            return inertia('Authenticated/ContentManagement/Media/Index', [
                'media'     => $media,
                'filters'   => $request->only(['search'])
            ]);
        } catch (Exception $e) {
            Log::error("Gagal memuat data media: " . $e->getMessage());
            return back()
                ->with([
                    'toast'     => false,
                    'icon'      => 'error',
                    'title'     => 'Gagal!',
                    'message'   => 'Terjadi kesalahan saat mengambil data! ' . $e->getMessage()
                ]);
        }
    }

    public function create() {
        return inertia('Authenticated/ContentManagement/Media/Create');
    }

    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'file'    => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
                'caption' => ['nullable', 'string', 'max:255'],
                'source'  => ['nullable', 'string', 'max:255'],
            ], [
                'file.required' => 'File gambar wajib dipilih!',
                'file.image'    => 'File harus berupa gambar!',
                'file.mimes'    => 'Format gambar harus jpg, jpeg, png, atau webp!',
                'file.max'      => 'Ukuran gambar maksimal 2MB!',
            ]);

            if ($request->hasFile('file')) {
                $path = $request->file('file')->store('media', 'public');
            }

            Media::create([
                'directory' => $path,
                'caption'  => $validated['caption'],
                'source'   => $validated['source'],
            ]);

            return redirect()
                ->route('media.index')
                ->with([
                    'toast'   => true,
                    'icon'    => 'success',
                    'message' => 'Media baru berhasil diupload!'
                ]);
        } catch (Exception $e) {
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            Log::error("Gagal upload media: " . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'toast'   => false,
                    'icon'    => 'error',
                    'title'   => 'Gagal!',
                    'message' => 'Terjadi kesalahan saat mengupload media! ' . $e->getMessage()
                ]);
        }
    }

    public function destroy(Media $medium) {
        try {
            $filePath = $medium->directory;

            $delete = $medium->delete();

            if ($delete) {
                if ($filePath && Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }

                return redirect()
                    ->back()
                    ->with([
                        'toast'     => true,
                        'icon'      => 'success',
                        'message'   => 'Data media berhasil dihapus!'
                    ]);
            }
            return redirect()
                ->back()
                ->with([
                    'toast'     => true,
                    'icon'      => 'warning',
                    'message'   => 'Data media gagal dihapus!'
                ]);
        } catch (Exception $e) {
            Log::error("Gagal hapus media: " . $e->getMessage());

            return redirect()
                ->back()
                ->with([
                    'toast'   => false,
                    'icon'    => 'error',
                    'title'   => 'Gagal!',
                    'message' => 'Gagal menghapus data! ' . $e->getMessage()
                ]);
        }
    }
}

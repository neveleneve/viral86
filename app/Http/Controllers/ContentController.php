<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller {
    public function index(Request $request) {
        try {
            $search = $request->search;

            $tags = Tag::get();
            $categories = Category::get();

            $content = Content::query()
                ->with('category', 'tags', 'user', 'media')
                ->when($search, function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                })
                ->when($request->category, function ($query, $categorySlug) {
                    $query->whereHas('category', function ($q) use ($categorySlug) {
                        $q->where('slug', $categorySlug);
                    });
                })
                ->when($request->tag, function ($query, $tagSlug) {
                    $query->whereHas('tags', function ($q) use ($tagSlug) {
                        $q->where('name', $tagSlug);
                    });
                })
                ->when($request->status, function ($query, $status) {
                    $query->where('status', $status);
                })
                ->orderBy('published_at', 'desc')
                ->paginate(5)
                ->withQueryString();;
            return inertia('Authenticated/ContentManagement/Content/Index', [
                'contents' => $content,
                'tags' => $tags,
                'categories' => $categories,
                'filters' => $request->only(['search', 'category', 'tag', 'status'])
            ]);
        } catch (Exception $e) {
            Log::error("Gagal memuat data konten: " . $e->getMessage());
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
        return inertia('Authenticated/ContentManagement/Content/Create', [
            'categories' => Category::select('id', 'name', 'slug')->get(),
        ]);
    }

    public function store(Request $request) {
        try {
            // code...
        } catch (Exception $e) {
            // code...
        }
    }

    public function show(string $id) {
        try {
            // code...
        } catch (Exception $e) {
            // code...
        }
    }

    public function update(Request $request, string $id) {
        try {
            // code...
        } catch (Exception $e) {
            // code...
        }
    }

    public function destroy(string $id) {
        try {
            // code...
        } catch (Exception $e) {
            // code...
        }
    }
}

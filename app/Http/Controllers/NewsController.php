<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsController extends Controller {
    public function landingPage() {
        $featuredNews = Content::with(['category', 'user', 'media'])
            // ->where('published_at', '>=', Carbon::now()->subDays(7))
            ->where('is_featured', true)
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(10)
            ->get();

        $trendingNews = Content::with(['category', 'user', 'media'])
            // ->where('published_at', '>=', Carbon::now()->subDays(7))
            ->where('status', 'published')
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        $latestNews = Content::with(['category', 'user', 'media'])
            // ->where('published_at', '>=', Carbon::now()->subDays(7))
            ->where('is_featured', false)
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(10)
            ->get();

        return inertia('LandingPage', [
            'featuredNews' => $featuredNews,
            'latestNews' => $latestNews,
            'trendingNews' => $trendingNews,
        ]);
    }

    public function newsDetail($category, $slug) {
        try {
            $content = Content::with('category', 'user', 'media', 'tags')->where('slug', $slug)->first();

            $cat = Category::where('slug', $category)->first();

            // this one is the correct one
            if (!$content || !$cat || $content->category_id !== $cat->id) {
                abort(404);
            }
            return inertia('NewsDetail', [
                'content' => $content,
                'category' => $cat
            ]);

            // this one is for testing purpose
            // return inertia('NewsDetail', [
            //     'category' => $cat
            // ]);
        } catch (NotFoundHttpException $e) {
            throw $e;
        } catch (Exception $e) {
            abort(500, 'Terjadi kesalahan pada server.');
        }
    }

    public function authorsPost($username) {
        //
    }

    public function tagNews($username) {
        //
    }

    public function categoryNews($username) {
        //
    }
}

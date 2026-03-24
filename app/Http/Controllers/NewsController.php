<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NewsController extends Controller {
    public function newsDetail($category, $slug) {
        try {
            $content = Content::with('category', 'user', 'media', 'tags')->where('slug', $slug)->first();

            $cat = Category::where('slug', $category)->first();

            // this one is the correct one
            if (!$content || !$cat || $content->category_id !== $cat->id) {
                abort(404);
            }
           
            // return $content;
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
}

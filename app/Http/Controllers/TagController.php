<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller {
    public function __construct() {
        //
    }

    public function index() {
        return inertia('Authenticated/ContentManagement/Tag/Index');
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show(Tag $tag) {
        //
    }

    public function edit(Tag $tag) {
        //
    }

    public function update(Request $request, Tag $tag) {
        //
    }

    public function destroy(Tag $tag) {
        //
    }
}

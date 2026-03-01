<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller {
    public function index() {
        return inertia('Authenticated/ContentManagement/Media/Index');
    }

    public function create() {
        return inertia('Authenticated/ContentManagement/Media/Create');
    }

    public function store(Request $request) {
        //
    }

    public function show(string $id) {
        //
    }

    public function edit(string $id) {
        //
    }

    public function update(Request $request, string $id) {
        //
    }

    public function destroy(string $id) {
        //
    }
}

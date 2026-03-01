<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller {
    public function index() {
        return inertia('Authenticated/ContentManagement/Content/Index');
    }

    public function create() {
        //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdsRequestController extends Controller {
    public function index() {
        return inertia('Authenticated/AdsManagement/AdsRequest/Index');
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

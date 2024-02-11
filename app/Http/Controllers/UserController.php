<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // index
    public function index() {
        // Get users with pagination
        $users = User::paginate(6);

        return view('pages.user.index', compact('users'));
    }

    // create
    public function create() {
        return view('pages.dashboard');
    }

    // store
    public function store(Request $request) {
        return view('pages.dashboard');
    }

    // show
    public function show($id) {
        return view('pages.dashboard');
    }

    // edit
    public function edit($id) {
        return view('pages.dashboard');
    }

    // update
    public function update(Request $request, $id) {
        return view('pages.dashboard');
    }

    // destroy
    public function destroy($id) {
        return view('pages.dashboard');
    }

}

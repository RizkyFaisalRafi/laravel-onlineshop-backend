<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    // index
    public function index(Request $request) {
        // Get users with pagination
        // $categories = \App\Models\Category::paginate(5);

        $categories = DB::table('categories')
        -> when($request -> input('name'),function ($query, $name){
            return $query-> where('name', 'like', '%' . $name. '%');
        }) -> paginate(5);


        return view('pages.category.index', compact('categories'));
    }

    // create
    function create() {
        return  view('pages.category.create');
    }

    // store
    function  store(Request $request) {
        $data = $request->all();
        // $data['password'] = Hash::make($request->input('password'));
        Category::create($data);
        return redirect()->route('category.index');
    }

    // // show
    // function show($id){
    //     return  view('pages.dashboard');
    // }

    // edit
    function edit($id) {
        $user = Category::findOrFail($id);
        return view('pages.category.edit', compact('user'));
    }

    // update
    function update(Request $request, $id) {
        $data = $request->all();
        $user = Category::findOrFail($id);
        //check if password is not empty
        // if ($request->input('password')) {
        //     $data['password'] = Hash::make($request->input('password'));
        // } else {
        //     //if password is empty, then use the old password
        //     $data['password'] = $user->password;
        // }
        $user->update($data);
        return redirect()->route('category.index');
    }

    // destroy
    function destroy($id) {
        $user = Category::findOrFail($id);
        $user->delete();
        return redirect()->route('category.index');
    }
}

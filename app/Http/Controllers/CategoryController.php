<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    // // create
    // function create() {
    //     return  view('pages.dashboard');
    // }

    // // store
    // function  store(Request $request) {
    //     return  view('pages.dashboard');
    // }

    // // show
    // function show($id){
    //     return  view('pages.dashboard');
    // }

    // // edit
    // function edit($id) {
    //     return  view('pages.dashboard');
    // }

    // // update
    // function update(Request $request, $id) {
    //     return  view('pages.dashboard');
    // }

    // // destroy
    // function destroy($id) {
    //     return  view('pages.dashboard');
    // }
}

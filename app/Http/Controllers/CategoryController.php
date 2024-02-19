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
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);
        $category = \App\Models\Category::create($validated);

        return redirect()->route('category.index') -> with('success','Category created successfully!');
    }

    // edit
    function edit($id) {
        $category = Category::findOrFail($id);
        return view('pages.category.edit', compact('category'));
    }

    // update
    function update(Request $request, $id) {
        $data = $request->all();
        $category = Category::findOrFail($id);

        $category->update($data);
        return redirect()->route('category.index') -> with( 'success', 'Category updated successfully!' );
    }

    // destroy
    function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index') -> with( 'success', 'Category deleted successfully!' );
    }
}

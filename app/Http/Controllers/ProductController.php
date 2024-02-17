<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // index
    public function index() {
        // Get users with pagination
        $products = \App\Models\Product::paginate(5); //  5 is the number of items to display per page.
        return view('pages.product.index', compact( 'products' )); // Send data to the product.index view file with the variable "products".
    }

    // create
    public function create(){
        $categories = \App\Models\Category::all();
        return view('pages.product.create', compact( 'categories'));
    }

    // store
    public function store(Request $request){
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/products', $filename);
        // $data = $request->all();

        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        $product->image = $filename;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product successfully created'); // Redirect user to products list after creation
    }

    // show
    public function show($id) {
        return  view('pages.dashboard');
    }

    // edit
    public function edit($id) {
        return  view('pages.dashboard');
    }

    // update
    public function update(Request $request, $id) {
        return  view('pages.dashboard');
    }

    // destroy
    public function destroy($id) {
        return  view('pages.dashboard');
    }



}

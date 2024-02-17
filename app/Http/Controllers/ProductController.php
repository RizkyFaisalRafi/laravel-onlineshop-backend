<?php

namespace App\Http\Controllers;

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
        return  view('pages.dashboard');
    }

    // store
    public function store(Request $request){
        return  view('pages.dashboard');
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

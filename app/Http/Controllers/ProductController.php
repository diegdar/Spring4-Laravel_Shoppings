<?php

namespace App\Http\Controllers;

use App\Http\Requests\validationProduct;
use App\Models\Product;
use Illuminate\Http\Request;
/*
🗒️NOTES:
1: compact('products'): it is the array that we collect in the variable $products
2: Mass assignment to insert/update records: Creates an instance of the product class and will pass the values received in the form to the 'description', 'unit_price' and 'category' fields and will also save these records in the DB internally with the save() method so it is better than passing the data one by one manually.
     ⚠️for it to work you must configure an attribute with the name $fillable or $guarded in the product Class.
3: we collect the selected product to edit.
     passes the fields of the selected product into view.

4: After deleting it will redirect the user to the list of records.
*/

class ProductController extends Controller
{
    // Show the products list
    public function index(){

        $products = Product::orderBy('id', 'desc')->paginate(); //note 1
        return view('products.index', compact('products'));//note 2

        // return $products;
    }
    // create a new product in the DB and show the product list 
    public function store(validationProduct $request){
        // return $request;

        Product::create($request->all());//note 1

        $products = Product::orderBy('id', 'desc')->paginate(); //note 1
        return view('products.index', compact('products'));//note 2
    }
    // Delete a product in the DB and show the product list
    public function destroy(Product $product){

        $product->delete();

        return redirect()->route('products.index');//note 4
    }
    // Show the update view of the selected product
    public function edit( Product $product){//note 3
        
        return view('products.edit', compact('product')); //note 3
    }
    // Update a product from the list
    public function update(validationProduct $request, Product $product){
        $product->update($request->all()); //note 2

        $products = Product::orderBy('id', 'desc')->paginate(); //note 1
        return view('products.index', compact('products'));//note 2

    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\validationProduct;
use App\Models\Product;
use Illuminate\Http\Request;
/*
🗒️NOTAS:
1: compact('products'): es el array que recogemos en la variable $products
2: Asignacion masiva para insertar/actualizar registros: Crea una instancia de la clase product y le pasará los valores recibidos en el formulario a los campos 'descripcion', ''unit_price' y 'category' y ademas guardará estos registros en la BBDD internamente con el metodo save() por lo que es mejor que pasar los datos uno por uno de forma manual. 
    ⚠️para que funcione hay que configurar en la Clase product un atributo con el nombre $fillable o $guarded.
3: recogemos el producto seleccionado para editar.
    pasa los campos del producto seleccionado a la vista.

4: Despues de eliminar redirigirá al usuario al listado de los registros.

*/

class ProductController extends Controller
{
    // Show the products list
    public function index(){

        $products = Product::orderBy('id', 'desc')->paginate(); //nota 1
        return view('products.index', compact('products'));//nota 2

        // return $products;
    }
    // create a new product in the DB and show the product list 
    public function store(validationProduct $request){
        // return $request;

        Product::create($request->all());//nota 1

        $products = Product::orderBy('id', 'desc')->paginate(); //nota 1
        return view('products.index', compact('products'));//nota 2
    }
    // Delete a product in the DB and show the product list
    public function destroy(Product $product){

        $product->delete();

        return redirect()->route('products.index');//nota 4
    }
    // Show the update view of the selected product
    public function edit( Product $product){//nota 3
        
        return view('products.edit', compact('product')); //nota 3
    }
    // Update a product from the list
    public function update(validationProduct $request, Product $product){
        $product->update($request->all()); //nota 2

        $products = Product::orderBy('id', 'desc')->paginate(); //nota 1
        return view('products.index', compact('products'));//nota 2

    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Models\Product;
use Illuminate\Http\Request;
/*
🗒️NOTAS:
1: paginate():pagina los registros devueltos. orderBy(): muestra el registro mas reciente primero.
2: view('products..)products es la carpeta donde esta la vista que a su vez estaria en view, e index seria el archivo de la vista.
    compact('products'): es el array que recogemos en la variable $products
3: Asignacion masiva para insertar registros: Crea una instancia de la clase product y le pasará los valores recibidos en el formulario a los atributos 'name', 'descripcion' y 'categoria' y ademas guardará estos registros en la BBDD internamente con el metodo save() por lo que es mejor que pasar los datos uno por uno de forma manual(como se muestra en arriba en lo que esta comentado) y se escribe mucho menos codigo. ⚠️para que funcione hay que configurar en la Clase product un atributo con el nombre $fillable o $guarded.

*/

class ProductController extends Controller
{
    public function index(){

        $products = Product::orderBy('id', 'desc')->paginate(); //nota 1
        return view('products.products_list', compact('products'));//nota 2

        // return $products;
    }
    // Muestra el listado de productos

    public function store(StoreProduct $request){
        $product = Product::create($request->all());//nota 3

        return view('products.products_list', compact('products'));//nota 2
    }

}

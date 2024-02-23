<?php

namespace App\Http\Controllers;

use App\Http\Requests\validationPurchase;
use App\Models\Purchase;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
/*
🗒️NOTES:
1: compact('purchases'): it is the array that we collect in the variable $purchases
2: Mass assignment to insert/update records: Creates an instance of the Purchase class and will pass the values received in the form to the 'description', 'unit_price' and 'category' fields and will also save these records in the DB internally with the save() method so it is better than passing the data one by one manually.
     ⚠️for it to work you must configure an attribute with the name $fillable or $guarded in the Purchase Class.
3: we collect the selected Purchase to edit.
     passes the fields of the selected Purchase into view.

4: After the method action is done we redirect the user to the list of the records.
5: Get all products sorted alphabetically by description.
6: We need as well all the products unsorted by description to match the 'id_product' and the position in the array $products
*/

class PurchaseController extends Controller
{
    
    // Show the purchases list
    public function index(){

        $purchases = Purchase::orderBy('id', 'desc')->paginate(); //note 1
        // return $purchases;
       
        return view('purchases.index', compact('purchases'));//note 2

    }

    // crea una nueva Compra en la BD y muestra la lista de Compras
    public function store(validationPurchase $request){
        $createdPurchase = Purchase::create($request->all());
        // return $createdPurchase;

        $sortedProducts = Product::orderBy('description')->get();//note 5
        // return $sortedProducts;
        $products = Product::all();//note 6

        return view('products_purchases.create', compact('products', 'sortedProducts', 'createdPurchase'));//note 2
        
        // return view('products_purchases.create');//note 2
    }   

    // Elimina una Compra en la BD y muestra la lista de Compras
    public function destroy(Purchase $purchase){

        $purchase->delete();

        return redirect()->route('purchases.index');//note 4
    }
    
    // Muestra la vista de actualización de la Compra seleccionada
    public function edit( Purchase $purchase){//note 3
        $sortedProducts = Product::orderBy('id', 'asc')->get();//note 5

        // return $purchase->product_id;
        
        return view('purchases.edit', compact('purchase', 'sortedProducts')); //note 3
    }
    // Actualiza la compra que se selecciono
    public function update(validationPurchase $request, Purchase $purchase){

        $purchase->update($request->all()); //note 2

        return redirect()->route('purchases.index');//note 4
    }

}

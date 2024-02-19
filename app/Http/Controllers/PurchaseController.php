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

    public function create(){
        // return $request;
        $sortedProducts = Product::orderBy('description')->get();//note 5
        // return $sortedProducts;
        $products = Product::all();//note 6

        return view('purchases.create', compact('products', 'sortedProducts'));//note 2
    }
    // create a new Purchase in the DB and show the Purchase list 
    public function store(validationPurchase $request){
        $purchase_date = $request->purchase_date;
        
        try {
            $date = Carbon::createFromFormat('d/m/Y', $purchase_date)->format('Y-m-d');
        } catch (\Exception $e) {
            // Manejar el error de formato de fecha
            return back()->withInput()->withErrors(['purchase_date' => 'Formato de fecha inválido']);
        }
    
        $data = $request->all();
        $data['purchase_date'] = $date;
    
        Purchase::create($data);
        
        return redirect()->route('purchases.index');
    }    // Delete a Purchase in the DB and show the Purchase list
    public function destroy(Purchase $purchase){

        $purchase->delete();

        return redirect()->route('purchases.index');//note 4
    }
    // Show the update view of the selected Purchase
    public function edit( Purchase $purchase){//note 3
        $sortedProducts = Product::orderBy('id', 'asc')->get();//note 5

        // return $purchase->product_id;
        // return $sortedProducts[42]->description;

        
        return view('purchases.edit', compact('purchase', 'sortedProducts')); //note 3
    }
    // Update a Purchase from the list
    public function update(validationPurchase $request, Purchase $purchase){

        $purchase->update($request->all()); //note 2

        return redirect()->route('purchases.index');//note 4
    }

}

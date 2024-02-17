<?php

namespace App\Http\Controllers;

use App\Http\Requests\validationPurchase;
use App\Models\Purchase;
use Illuminate\Http\Request;

/*
🗒️NOTES:
1: compact('Purchases'): it is the array that we collect in the variable $Purchases
2: Mass assignment to insert/update records: Creates an instance of the Purchase class and will pass the values received in the form to the 'description', 'unit_price' and 'category' fields and will also save these records in the DB internally with the save() method so it is better than passing the data one by one manually.
     ⚠️for it to work you must configure an attribute with the name $fillable or $guarded in the Purchase Class.
3: we collect the selected Purchase to edit.
     passes the fields of the selected Purchase into view.

4: After deleting it will redirect the user to the list of records.
*/

class PurchaseController extends Controller
{
    // Show the Purchases list
    public function index(){

        $Purchases = Purchase::orderBy('id', 'desc')->paginate(); //note 1
        return view('Purchases.index', compact('Purchases'));//note 2

        // return $Purchases;
    }
    // create a new Purchase in the DB and show the Purchase list 
    public function store(validationPurchase $request){
        // return $request;

        Purchase::create($request->all());//note 1

        $Purchases = Purchase::orderBy('id', 'desc')->paginate(); //note 1
        return view('Purchases.index', compact('Purchases'));//note 2
    }
    // Delete a Purchase in the DB and show the Purchase list
    public function destroy(Purchase $Purchase){

        $Purchase->delete();

        return redirect()->route('Purchases.index');//note 4
    }
    // Show the update view of the selected Purchase
    public function edit( Purchase $Purchase){//note 3
        
        return view('Purchases.edit', compact('Purchase')); //note 3
    }
    // Update a Purchase from the list
    public function update(validationPurchase $request, Purchase $Purchase){
        $Purchase->update($request->all()); //note 2

        $Purchases = Purchase::orderBy('id', 'desc')->paginate(); //note 1
        return view('Purchases.index', compact('Purchases'));//note 2

    }

}

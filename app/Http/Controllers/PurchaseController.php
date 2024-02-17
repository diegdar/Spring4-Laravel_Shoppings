<?php

namespace App\Http\Controllers;

use App\Http\Requests\validationPurchase;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(){

        $purchase = Purchase::orderBy('id', 'desc')->paginate(); //nota 1
        return view('purchase.index', compact('purchase'));//nota 2

        // return $purchase;
    }
    // create a new Purchase in the DB and show the Purchases list 
    public function store(validationPurchase $request){
        // return $request;

        Purchase::create($request->all());//nota 1

        $purchase = Purchase::orderBy('id', 'desc')->paginate(); //nota 1
        return view('purchase.index', compact('purchase'));//nota 2
    }
    // Delete a Purchase in the DB and show the Purchase list
    public function destroy(Purchase $purchase){

        $purchase->delete();

        return redirect()->route('purchase.index');//nota 4
    }
    // Show the update view of the selected Purchase
    public function edit( Purchase $purchase){//nota 3
        
        return view('purchase.edit', compact('Purchase')); //nota 3
    }
    // Update a Purchase from the list
    public function update(validationPurchase $request, Purchase $purchase){
        $purchase->update($request->all()); //nota 2

        $purchase = Purchase::orderBy('id', 'desc')->paginate(); //nota 1
        return view('purchase.index', compact('purchase'));//nota 2

    }

}

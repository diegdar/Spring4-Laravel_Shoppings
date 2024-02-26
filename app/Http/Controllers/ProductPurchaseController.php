<?php

namespace App\Http\Controllers;

use App\Http\Requests\validationProductPurchase;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ProductPurchaseController extends Controller
{
    public function store(validationProductPurchase $request)
    {
        
        return $request;
        // Verifica si ya existe una compra con el mismo purchase_id y product_id
        $existingPurchase = ProductPurchase::where('purchase_id', $request->purchase_id)
            ->where('product_id', $request->product_id)
            ->first();

        $products = Product::all(); // Obtiene todos los productos
        $sortedProducts = Product::orderBy('description')->get(); // Obtiene los productos ordenados por descripción

        $purchase_id = $request->purchase_id;
        $purchase_date = $request->purchase_date;
        $supermarket = $request->supermarket;

        if ($existingPurchase) {
            $productsPurchases = ProductPurchase::orderBy('id','desc')->get(); // Obtiene las compras ordenadas por id mostrando la mas reciente primero
        } else {
            $import = $request->quantity * $request->unit_price;

            $productPurchase = ProductPurchase::create([
                'purchase_id' => $request->purchase_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
                'import' => $import,
            ]);

            $productsPurchases = ProductPurchase::orderBy('id','desc')->get(); 
            // Obtiene el registro de la compra por su id
            $record = Purchase::find($purchase_id);
            // Actualizar el valor del campo
            $record->total_import += $import;

            // Guardar los cambios en la BBDD
            $record->save();

        }

        return view('products_purchases.create', compact('products', 'sortedProducts', 'productsPurchases', 'purchase_id', 'purchase_date', 'supermarket'));
    }

    public function destroy(ProductPurchase $productPurchase, Request $purchase)
    {
        $productPurchase->delete(); // Elimina la compra de producto

        $products = Product::all(); // Obtiene todos los productos
        $sortedProducts = Product::orderBy('description')->get(); // Obtiene los productos ordenados por descripción
        $productsPurchases = ProductPurchase::orderBy('id','desc')->get(); // Obtiene las compras ordenadas por id

        $purchase_id = $purchase->purchase_id;
        $purchase_date = $purchase->purchase_date;
        $supermarket = $purchase->supermarket;

        return view('products_purchases.create', compact('products', 'sortedProducts', 'productsPurchases', 'purchase_id', 'purchase_date', 'supermarket'));
    }
}
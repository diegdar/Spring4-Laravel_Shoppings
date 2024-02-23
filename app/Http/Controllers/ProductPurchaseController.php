<?php

namespace App\Http\Controllers;

use App\Http\Requests\validationProductPurchase;
use App\Models\Product;
use App\Models\ProductPurchase;
use Illuminate\Http\Request;

class ProductPurchaseController extends Controller
{
    public function store(validationProductPurchase $request)
    {
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
            $productsPurchases = ProductPurchase::all(); // Obtiene todas las compras de productos
        } else {
            $productPurchase = ProductPurchase::create([
                'purchase_id' => $request->purchase_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'unit_price' => $request->unit_price,
            ]);
            $productsPurchases = ProductPurchase::orderBy('id','desc')->get(); // Obtiene las compras ordenadas por id
        }

        return view('products_purchases.create', compact('products', 'sortedProducts', 'productsPurchases', 'purchase_id', 'purchase_date', 'supermarket'));
    }

    public function destroy(ProductPurchase $productPurchase, Request $request)
    {
        $purchase_id = $request->purchase_id;
        $purchase_date = $request->purchase_date;
        $supermarket = $request->supermarket;

        $productPurchase->delete(); // Elimina la compra de producto

        $products = Product::all(); // Obtiene todos los productos
        $sortedProducts = Product::orderBy('description')->get(); // Obtiene los productos ordenados por descripción
        $productsPurchases = ProductPurchase::orderBy('id','desc')->get(); // Obtiene las compras ordenadas por id

        return view('products_purchases.create', compact('products', 'sortedProducts', 'productsPurchases', 'purchase_id', 'purchase_date', 'supermarket'));
    }
}
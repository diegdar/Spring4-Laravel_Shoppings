<?php

namespace App\Http\Controllers;

use App\Http\Requests\validationProductPurchase;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use Illuminate\Http\Request;
/*
🗒️NOTAS:
1: Devuelve el importe total actual de la compra
*/
class ProductPurchaseController extends Controller
{
    // public function index( $request)
    // {
    //     $this->store($request);
    // }

    // public function show( $request)
    // {
    //     $this->store($request);

    // }

    public function store(validationProductPurchase $request)
    {
        // Reemplaza las comas por puntos en el valor de unit_price 
        $unitPrice = (float) str_replace(',', '.', $request->unit_price);

        // Comprueba que no haya sido añadido el mismo producto a la compra 
        $productPurchase = $this->CheckDuplicatedProducts($request, $unitPrice);

        $purchase_id =  $request->purchase_id;
        $purchase_date = $request->purchase_date;
        $supermarket = $request->supermarket;

        $totalImport = $this->getTotalImport($purchase_id); //nota 1

        $products = Product::all();
        $sortedProducts = Product::orderBy('description')->get();
        $productsPurchases = ProductPurchase::orderBy('id', 'desc')->get();

        return view('productPurchases.create', compact(
            'products',
            'sortedProducts',
            'productsPurchases',
            'purchase_id',
            'purchase_date',
            'supermarket',
            'totalImport'
        ));
    }

    public function getTotalImport($purchaseId): float
    {
        $totalImport = ProductPurchase::where('purchase_id', $purchaseId)->sum('import');
        return $totalImport;
    }

    // Funcion auxiliar para comprobar que no haya sido añadido el mismo producto a la compra
    private function CheckDuplicatedProducts($request, float $unitPrice)
    {
        return ProductPurchase::firstOrCreate([
            'purchase_id' => $request->purchase_id,
            'product_id' => $request->product_id,
        ], [
            'quantity' => $request->quantity,
            'unit_price' => $unitPrice,
            'import' => $request->quantity * $unitPrice,
        ]);
    }

    // Elimina un producto de la compra
    public function destroy(ProductPurchase $productPurchase, Request $purchase)
    {
        $productPurchase->delete(); // Elimina la compra de producto

        $products = Product::all(); // Obtiene todos los productos
        $sortedProducts = Product::orderBy('description')->get(); // Obtiene los productos ordenados por descripción
        $productsPurchases = ProductPurchase::orderBy('id', 'desc')->get(); // Obtiene las compras ordenadas por id

        $purchase_id = $purchase->purchase_id;
        $purchase_date = $purchase->purchase_date;
        $supermarket = $purchase->supermarket;
 
        $totalImport = $this->getTotalImport($purchase_id); //nota 1

        return view('productPurchases.create', compact(
            'products', 
            'sortedProducts', 
            'productsPurchases', 
            'purchase_id', 
            'purchase_date', 
            'supermarket',
            'totalImport',
        ));
    }
}

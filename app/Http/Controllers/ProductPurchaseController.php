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
        // Reemplaza las comas por puntos en el valor de unit_price
        $unitPrice = str_replace(',', '.', $request->unit_price);

        // Comprueba que no haya sido añadido el mismo producto a la compra
        $productPurchase = $this->CheckDuplicatedProducts($request, $unitPrice);

        $purchaseId = $productPurchase->purchase_id;
        // Actualiza el total_import de la compra
        $this->updateTotalImport($purchaseId, $productPurchase->import);
        // Devuelve el importe total actual de la compra
        $totalImport = $this->getTotalImport($purchaseId);

        $products = Product::all();
        $sortedProducts = Product::orderBy('description')->get();
        $productsPurchases = ProductPurchase::orderBy('id', 'desc')->get();
        $purchase_id = $request->purchase_id;
        $purchase_date = $request->purchase_date;
        $supermarket = $request->supermarket;

        return view('products_purchases.create', compact(
            'products',
            'sortedProducts',
            'productsPurchases',
            'purchase_id',
            'purchase_date',
            'supermarket',
            'totalImport'
        ));
    }

    // Función auxiliar para actualizar el total_import
    private function updateTotalImport(int $purchaseId, int $import)
    {
        $record = Purchase::find($purchaseId);
        $record->total_import += $import;
        $record->save();
    }

    public function getTotalImport(int $purchaseId):int
    {
        $purchase= Purchase::find($purchaseId);
        return $purchase->total_import;
    }

    // Funcion auxiliar para comprobar que no haya sido añadido el mismo producto a la compra
    private function CheckDuplicatedProducts($request, int $unitPrice)
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


    public function destroy(ProductPurchase $productPurchase, Request $purchase)
    {
        $productPurchase->delete(); // Elimina la compra de producto

        $products = Product::all(); // Obtiene todos los productos
        $sortedProducts = Product::orderBy('description')->get(); // Obtiene los productos ordenados por descripción
        $productsPurchases = ProductPurchase::orderBy('id', 'desc')->get(); // Obtiene las compras ordenadas por id

        $purchase_id = $purchase->purchase_id;
        $purchase_date = $purchase->purchase_date;
        $supermarket = $purchase->supermarket;

        return view('products_purchases.create', compact('products', 'sortedProducts', 'productsPurchases', 'purchase_id', 'purchase_date', 'supermarket'));
    }
}

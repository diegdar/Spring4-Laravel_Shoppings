{{-- 
🗒️noteS:
1: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
2: mostrara un mensaje personalizado cuando no se cumpla la validacion del campo.
3: We have to subtract 1 unit to match the array position with the product_id      
    --}}
@extends('layouts.plantilla')

@section('title', 'Productos de la compra')

@section('content')

    {{-- Data insertion rows --}}
    <form action="{{ route('productPurchases.store') }}" method="POST">
        @csrf{{-- note 1 --}}
        <table class="w-full flex items-center justify-center flex-grow-0">
            <tr>
                <td>
                    <label for="purchase_id">Compra Nº</label>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" style="text-align: center;" id="purchase_id"
                            value="{{ isset($createdPurchase->id) ? $createdPurchase->id : $purchase_id }}" readonly
                            name="purchase_id">
                    </div>
                </td>
                <td>
                    <label for="purchase_date">Fecha Compra:</label>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="date" style="text-align: center;"
                            value="{{ isset($createdPurchase->id) ? $createdPurchase->purchase_date : $purchase_date }}"
                            readonly>
                    </div>
                </td>
                <td>
                    <label for="supermarket">Supermercado:</label>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" style="text-align: center;" id="supermarket"
                            value="{{ isset($createdPurchase->id) ? $createdPurchase->supermarket : $supermarket }}"
                            readonly name="supermarket">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="product_id">Producto:</label>
                </td>
                {{-- insert products --}}
                <td>
                    <select name="product_id" id="product_id" class='px-4 py-2 border border-blue-200 rounded'>
                        <option value="--">--Elige un producto--</option>
                        @foreach ($sortedProducts as $productPurchase)
                            <option value="{{ $productPurchase->id }}">{{ $productPurchase->description }}</option>
                        @endforeach
                        @error('product_id')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </select>
                </td>
                <td>
                    <label for="quantity">Cantidad:</label>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="number" name="quantity" style="text-align: center;" id="quantity" min="1"
                            max="100">
                        @error('quantity')
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td>
                    <label for="unit_price">Precio unitario:</label>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="decimal" style="text-align: center;" name="unit_price" id="unit_price">
                        @error('unit_price')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td class='py-2 px-4'><input type='submit' value='Insertar producto'
                        onclick="return validateProduct(event)"
                        class='bg-blue-600 text-white px-7 py-2 rounded hover:bg-blue-300'>
                </td>
            </tr>
        </table>
    </form>
    <h1 class="text-5xl text-center text-red-500 my-4">
        Importe Total productos añadidos:
        {{ number_format(isset($totalImport) ? $totalImport : 0, 2, ',', '.') }}€
    </h1>
    {{-- Products Table --}}
    <table class="w-full flex items-center justify-center flex-grow-0">
        {{-- Table header rows --}}
        <tr>
            <th class="w-48">Ref. producto</th>
            <th class="w-48">Descripcion</th>
            <th class="w-48">Precio Unidad</th>
            <th class="w-48">Cantidad</th>
            <th class="w-48">Importe</th>
            <th class="w-48">Unidad de medida</th>
        </tr>
        {{-- Data insertion Products rows --}}
        </tr>
        {{-- List products already created --}}
        @if (isset($productsPurchases))
            @foreach ($productsPurchases as $productPurchase)
                @if ($productPurchase->purchase_id == $purchase_id)
                    <tr>
                        <td class="text-center">
                            {{ $productPurchase->product_id }}
                        </td>
                        <td class="text-center">
                            {{ $products[$productPurchase->product_id - 1]->description }}
                        </td>
                        <td class="text-center">
                            {{ number_format($productPurchase->unit_price, 2, ',', '.') }}€
                        </td>
                        <td class="text-center">
                            {{ $productPurchase->quantity }}
                        </td>
                        <td class="text-center">
                            {{ number_format($productPurchase->import, 2, ',', '.') }}€
                        </td>
                        <td class="text-center">
                            {{ $products[$productPurchase->product_id - 1]->measurement_unit }}
                        </td>
                        {{-- Delete button --}}
                        <td class="py-2 px-4">
                            <form action="{{ route('productPurchases.destroy', $productPurchase->id) }}" method="POST">
                                @csrf {{-- note 1 --}}
                                @method('delete') {{-- note 2 --}}
                                <input type="hidden" name="purchase_id" value="{{ $purchase_id }}">
                                <input type="hidden" name="purchase_date" value="{{ $purchase_date }}">
                                <input type="hidden" name="supermarket" value="{{ $supermarket }}">
                                <button type="submit" onclick="return confirmDelete('{{ $productPurchase->product_id }}')"
                                    class="bg-red-500 text-white mt-4 px-8 py-2 rounded hover:bg-red-300">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endif
    </table>
@endsection

<script>
    function confirmDelete(product_id) {
        return confirm("¿Estás seguro de que deseas borrar el produtco con referencia Nº: " + product_id + "?");
    }

    function validateProduct(event) {
        const product_id = document.getElementById('product_id').value;
        const quantity = document.getElementById('quantity').value;
        const unitPrice = document.getElementById('unit_price').value;

        if (product_id === '--') {
            alert('¡Debes elegir un producto!');
            event.preventDefault(); // Prevent form submission
            return false;
        }
        if (quantity.trim() === '') {
            alert('¡Debes introducir un valor en la casilla de cantidad!');
            event.preventDefault(); // Prevent form submission
            return false;
        }

        if (unitPrice.trim() === '') {
            alert('¡Debes introducir un valor en la casilla de precio unitario!');
            event.preventDefault(); // Previene enviar el formulario
            return false;
        }

        return true; // Envia el formulario si no hay erro de validacion
    }
</script>

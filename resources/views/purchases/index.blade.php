{{-- 
🗒️noteS:
1: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
2: mostrara un mensaje personalizado cuando no se cumpla la validacion del campo.
3: We have to subtract 1 unit to match the array position with the product_id      
    --}}
@extends('layouts.plantilla')

@section('title', 'Lista Compras')

@section('content')

    <h1 class="text-6xl text-center text-red-500 my-4">Lista Productos Comprados</h1>
    <table class="flex items-center justify-center">
        {{-- Table header rows --}}
        <tr>
            <th>Fecha compra</th>
            <th>Cantidad</th>
            <th>Importe</th>
            <th>Supermercado</th>
            <th>Producto Comprado</th>
        </tr>
        <tr>
            {{-- Data insertion rows --}}
            <form action="{{ route('purchases.store') }}" method="POST">
                @csrf{{-- note 1 --}}
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" class="h-9" name="purchase_date">
                        @error('purchase_date')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" class="h-9" name="quantity" >
                        @error('quantity')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" class="h-9" name="amount">
                        @error('amount')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" class="h-9" name="supermarket">
                        @error('supermarket')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <select name="product_id" id="product_id" class='px-4 py-2 border border-blue-200 rounded'>
                            <option value="">--Elige un producto--</option>
                            @foreach ($sortedProducts as $product)
                                <option value="{{ $product->id }}">{{ $product->description }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td class='py-2 px-4'><input type='submit' value='Insertar'
                        class='bg-blue-600 text-white px-7 py-2 rounded hover:bg-blue-300'>
                </td>
            </form>
        </tr>
        </form>
        {{-- List purchases already created --}}
        @foreach ($purchases as $purchase)
            <tr>
                <td class="text-center">
                    {{ $purchase->purchase_date }}
                </td>
                <td class="text-center">
                    {{ $purchase->quantity }}
                </td>
                <td class="text-center">
                    {{ $purchase->amount }}
                </td>
                <td class="text-center">
                    {{ $purchase->supermarket }}
                </td>
                <td class="text-center">
                    {{ $products[$purchase->product_id-1]->description}}{{-- note 3 --}}
                </td>
                {{-- Delete button --}}
                <td class="py-2 px-4">
                    <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST">
                        @csrf{{-- note 1 --}}
                        @method('delete'){{-- note 2 --}}
                        <button type="submit" onclick="return confirmDelete('{{ $purchase->purchase_date }}')"
                            class='bg-red-500 text-white mt-4 px-8 py-2 rounded hover:bg-red-300'>Borrar</button>
                    </form>
                </td class="py-2 px-4">
                {{-- Update button --}}
                <td>
                    <a href="{{ route('purchases.edit', $purchase->id) }}">
                        <input type='button' name='up' id='up' value='Actualizar'
                            class='bg-yellow-700 text-white px-4 py-2 rounded hover:bg-yellow-500'>
                    </a>
            </tr>
        @endforeach
    </table>
    {{ $purchases->links() }}
@endsection

<script>
    function confirmDelete(purchasepurchase_date) {
        return confirm("¿Estás seguro de que deseas borrar la compra hecha el dia: " + purchasepurchase_date + "?");
    }
</script>

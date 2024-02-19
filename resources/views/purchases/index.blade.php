{{-- 
🗒️noteS:
1: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
2: mostrara un mensaje personalizado cuando no se cumpla la validacion del campo.
3: We have to subtract 1 unit to match the array position with the product_id      
    --}}
@extends('layouts.plantilla')

@section('title', 'Lista Compras')

@section('content')
@php
use Carbon\Carbon;
@endphp

    <h1 class="text-6xl text-center text-red-500 my-4">Lista Productos Comprados</h1>
    <table class="w-full flex items-center justify-center flex-grow-0">
        {{-- Table header rows --}}
            <tr>
                <th class="w-48">Nº Compra</th>
                <th class="w-48">Fecha Compra</th>
                <th class="w-48">Supermercado</th>
                <th class="w-48">Importe Total</th>
                <th>
                    <a href="{{ route('purchases.create') }}">
                        <input type='button' value='Crear nueva Compra'
                            class='bg-blue-700 text-white px-4 py-2 m-3 rounded hover:bg-blue-500 my-2'>
                    </a>
                </th>
            </tr>
            <tr>
                {{-- List purchases already created --}}
                @foreach ($purchases as $purchase)
            <tr>
                <td class="text-center">
                    {{ $purchase->id }}
                </td>
                <td class="text-center">
                    {{ Carbon::parse($purchase->purchase_date)->format('d/m/Y') }}
                </td>
                <td class="text-center">
                    {{ $purchase->supermarket }}
                </td>
                <td class="text-center">
                    ⚠️:falta importe total
                </td>
                {{-- Delete button --}}
                <td class="py-2 px-4">
                    <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST">
                        @csrf{{-- note 1 --}}
                        @method('delete'){{-- note 2 --}}
                        <button type="submit" onclick="return confirmDelete('{{ $purchase->id }}')"
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
    function confirmDelete(id_purchase) {
        return confirm("¿Estás seguro de que deseas borrar la compra Nº: " + id_purchase + "?");
    }
</script>

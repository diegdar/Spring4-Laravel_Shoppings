{{-- 
🗒️noteS:
1: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
2: mostrara un mensaje personalizado cuando no se cumpla la validacion del campo.
3: We have to subtract 1 unit to match the array position with the product_id      
    --}}
@extends('layouts.plantilla')

@section('title', 'Editar Compra')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <h1 class="text-6xl text-center text-red-500 my-4">Editar Compra Nº: {{ $purchase->id }}</h1>
    {{-- Data insertion rows --}}
    <form action="{{ route('purchases.update', $purchase->id) }}" method="POST">
        @csrf{{-- note 1 --}}
        <table class="w-full flex items-center justify-center flex-grow-0">
            @method('put'){{-- note 3 --}}
            <tr>
                <td>
                    <input type="hidden" style="text-align: center;"
                    value="{{ $purchase->id}}"
                    name="purchase_date">
                </td>
                <td>
                    <label for="purchase_date">Fecha Compra:</label>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="date" style="text-align: center;"
                            value="{{ old('purchase_date', $purchase->purchase_date) }}"
                            name="purchase_date">{{-- note 5 --}}
                        @error('purchase_date')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td>
                    <label for="supermarket">Supermercado:</label>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" style="text-align: center;"
                            value="{{ old('supermarket', $purchase->supermarket) }}"
                            name="supermarket">{{-- note 5 --}}
                        @error('supermarket')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror

                    </div>
                </td>
                <td class='py-2 px-4'><input type='submit' value='Guardar Cambios'
                        class='bg-blue-600 text-white px-7 py-2 rounded hover:bg-blue-300'>
                </td>
        </table>
    </form>
@endsection

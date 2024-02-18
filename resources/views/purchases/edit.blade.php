{{-- 🗒️noteS:
1: nombre de la ruta que buscará en  routes\web.php.
2: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
3: como html no entiende el metodo 'PUT' hay que dejarlo como 'POST' en la lina del form y aqui poner 'PUT' para que laravel entienda que se enviara de esta forma.
4: solo se imprimira este error si hay un error de validacion: ‼️hay que poner dentro el nombre del input, en este caso es 'name', 'descripcion' o 'categoria'.
5: el metodo old() si el usuario cambio el dato original devolvera el primero de sus parametros, pero si no cambio nada devolvera el valor del objeto del registro(su segundo paremtro)  
6: With this way we can recue the value that the product had from the row record.
7: Show all the products in the select as options
    --}}

@extends('layouts.plantilla')

@section('title', 'Editar purchaseo')

@section('content')
    <h1 class="text-4xl	text-red-500 font-semibold">Edicion de la Compra:</h1>
    <a href="{{ route('purchases.index', $purchase->id) }}">
        <input type='button' value='Volver a lista Compras'
            class='bg-yellow-700 text-white px-4 py-2 rounded hover:bg-yellow-500 my-2'>
    </a>
    {{-- note 1 --}}
    <form action="{{ route('purchases.update', $purchase->id) }}" method="post" class="my-5 mx-3">
        @csrf {{-- note 2 --}}
        @method('put'){{-- note 3 --}}
        <label>
            Fecha Compra:
        </label>
        <br>
        <input type="text" name="purchase_date" class="h-9 w-27"
            value="{{ old('purchase_date', $purchase->purchase_date) }}">{{-- note 5 --}}
        @error('purchase_date')
            {{-- note 4 --}}
            <br>
            <span class="textValidation">*{{ $message }}</span>
            <br>
        @enderror
        <br>
        <label>
            Cantidad:
        </label>
        <br>
        <input type="text" name="quantity" class="h-9 w-27"
            value="{{ old('quantity', $purchase->quantity) }}">{{-- note 5 --}}
        @error('quantity')
            {{-- note4 --}}
            <br>
            <span class="textValidation">*{{ $message }}</span>
            <br>
        @enderror
        <br>
        <label>
            Importe:
        </label>
        <br>
        <input type="text" name="amount" class="h-9 w-27"
            value="{{ old('amount', $purchase->amount) }}">{{-- note 5 --}}
        @error('amount')
            {{-- note4 --}}
            <br>
            <span class="textValidation">*{{ $message }}</span>
            <br>
        @enderror
        <br>
        <label>
            Supermercado:
        </label>
        <br>
        <input type="text" name="supermarket" class="h-9 w-27"
            value="{{ old('supermarket', $purchase->supermarket) }}">{{-- note 5 --}}
        @error('supermarket')
            {{-- note4 --}}
            <br>
            <span class="textValidation">*{{ $message }}</span>
            <br>
        @enderror
        <br>
        <label>
            Producto:
        </label>
            <br>
            <select name="product_id" id="product_id" class='px-4 py-2 border border-blue-200 rounded'>
                <option value="{{ old('supermarket', $purchase->product_id) }}">{{ $sortedProducts[$purchase->product_id-1]->description}}{{--note 6--}}</option>
                @foreach ($sortedProducts as $product){{--note 7--}}
                    <option value="{{ $product->id }}">{{ $product->description }}</option>                    
                @endforeach
            </select>
            @error('product_id')
                {{-- note 2 --}}
                <span class="textValidation">*{{ $message }}</span>
            @enderror
            <br>
            <button type="submit" class='bg-blue-600 text-white px-7 py-2 rounded hover:bg-blue-300 my-3'>Actualizar
                Compra</button>
    </form>


@endsection

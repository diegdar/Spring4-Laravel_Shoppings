{{-- 🗒️noteS:
1: nombre de la ruta que buscará en  routes\web.php.
2: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
3: como html no entiende el metodo 'PUT' hay que dejarlo como 'POST' en la lina del form y aqui poner 'PUT' para que laravel entienda que se enviara de esta forma.
4: solo se imprimira este error si hay un error de validacion: ‼️hay que poner dentro el nombre del input, en este caso es 'name', 'descripcion' o 'categoria'.
5: el metodo old() si el usuario cambio el dato original devolvera el primero de sus parametros, pero si no cambio nada devolvera el valor del objeto del registro(su segundo paremtro)  
    
    --}}

@extends('layouts.plantilla')

@section('title', 'Editar Producto')

@section('content')
    <h1 class="text-4xl	text-red-500 font-semibold">Edicion del producto:</h1>
    <a href="{{ route('products.index', $product->id) }}">
        <input type='button' value='Volver a lista productos'
            class='bg-yellow-700 text-white px-4 py-2 rounded hover:bg-yellow-500 my-2'>
    </a>
        {{-- note 1 --}}
        <form action="{{ route('products.update', $product->id) }}" method="post" class="my-5 mx-3">
            @csrf {{-- note 2 --}}
            @method('put'){{-- note 3 --}}
            <label>
                Descripcion producto:
            </label>
            <br>
            <input type="text" name="description" class="h-9 w-27"
                value="{{ old('description', $product->description) }}">{{-- note 5 --}}
            @error('description')
                {{-- note 4 --}}
                <br>
                <span class="textValidation">*{{ $message }}</span>
                <br>
            @enderror
            <br>
            <label>
                Precio unitario del producto:
            </label>
            <br>
            <input type="text" name="unit_price" class="h-9 w-27"
                value="{{ old('unit_price', $product->unit_price) }}">{{-- note 5 --}}
            @error('unit_price')
                {{-- note4 --}}
                <br>
                <span class="textValidation">*{{ $message }}</span>
                <br>
            @enderror
            <br>
            <label>
                Categoria del producto:
                <br>
                <select name="category" id="category" class='px-4 py-2 border border-blue-200 rounded'>
                    <option value="{{ old('category', $product->category) }}">{{$product->category}}</option>
                    <option value="Alimentacion">Alimentacion</option>
                    <option value="Limpieza">Limpieza</option>
                    <option value="Higiene personal">Higiene personal</option>
                    <option value="Hogar">Hogar</option>
                </select>
                @error('category')
                    {{-- note 2 --}}
                    <br>
                    <span class="textValidation">*{{ $message }}</span>
                @enderror
                <br>
                <button type="submit" class='bg-blue-600 text-white px-7 py-2 rounded hover:bg-blue-300 my-3'>Actualizar
                    producto</button>
        </form>


    @endsection

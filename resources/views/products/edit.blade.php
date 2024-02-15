{{-- 🗒️NOTAS:
1: nombre de la ruta que buscará en  routes\web.php.
2: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
3: como html no entiende el metodo 'PUT' hay que dejarlo como 'POST' en la lina del form y aqui poner 'PUT' para que laravel entienda que se enviara de esta forma.
4: solo se imprimira este error si hay un error de validacion: ‼️hay que poner dentro el nombre del input, en este caso es 'name', 'descripcion' o 'categoria'.
5: el metodo old() si el usuario cambio el dato original devolvera el primero de sus parametros, pero si no cambio nada devolvera el valor del objeto del registro(su segundo paremtro)  
    
    --}}

@extends('layouts.plantilla')

@section('title', 'Editar Producto')

@section('content')
    <h1 class="text-3xl	font-extralight	text-red-500 ont-bold">Edicion del producto: <span>{{ $product->description }}</span></h1>
    {{-- nota 1 --}}
    <form action="{{ route('products.update', $product->id) }}" method="post">
        @csrf {{-- nota 2 --}}
        @method('put')
        {{-- nota 3 --}}
        <label>
            Descripcion producto:
            <br>
            <input type="text" name="description"
                value="{{ old('description', $product->description) }}">{{-- nota 5 --}}
        </label>
        @error('description')
            {{-- nota4 --}}
            <br>
            <span>*{{ $message }}</span>
            <br>
        @enderror
        <br>
        <label>
            Precio unitario del producto:
            <br>
            <input type="text" name="unit_price" value="{{ old('unit_price', $product->unit_price) }}">{{-- nota 5 --}}
        </label>
        @error('unit_price')
            {{-- nota4 --}}
            <br>
            <span>*{{ $message }}</span>
            <br>
        @enderror
        <br>
        <label>
            Categoria del producto:
            <br>
            <input type="text" name="category" value="{{ old('category', $product->category) }}">{{-- nota 5 --}}
        </label>
        @error('category')
            {{-- nota4 --}}
            <br>
            <span>*{{ $message }}</span>
            <br>
        @enderror
        <br>
        <button type="submit" class='bg-blue-600 text-white px-7 py-2 rounded hover:bg-blue-300 my-3'>Actualizar formulario</button>
    </form>


@endsection

@extends('layouts.plantilla')

@section('title', 'Home')

@section('content')
    <h1>APLICACION COMPRAS SUPERMERCADOS</h1>

    <a href="{{ route('purchases.index') }}">
        <input type='button' value='Listado de Compras'
            class='bg-yellow-700 text-white px-4 py-2 rounded hover:bg-yellow-500 my-2'>
    </a>
    <a href="{{ route('products.index') }}">
        <input type='button' value='Listado de Productos'
            class='bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-500 my-2'>
    </a>
@endsection
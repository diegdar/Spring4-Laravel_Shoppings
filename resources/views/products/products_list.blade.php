@extends('layouts.plantilla')

@section('title', 'Productos')

@section('content')
    <h1>Lista de Productos</h1>
    <a href="{{route('products.create')}}">crear producto</a>
        <table>
            {{-- Filas encabezados tabla --}}
            <tr>
                <th>descripcion Producto</th>
                <th>precio unitario</th>
                <th>categoria</th>
            </th>
            {{-- Filas inserccion datos --}}
            <tr>
                <td>
                    <input type="text" name="description">
                </td>
            </tr>
        @foreach ($products as $product)
            <li>                         
                                              {{-- pasamos el 'id' como parametro al metodo show del controlador --}}
                <a href="{{route('products.show', $product->id)}}">{{$product->description}}</a>                                          
            </li>
        @endforeach
        </table>
    {{$products->links()}}
@endsection


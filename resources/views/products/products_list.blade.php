{{-- 
🗒️NOTAS:
1: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
    
    --}}
@extends('layouts.plantilla')

@section('title', 'Productos')

@section('content')
    @vite('resources/css/app.css')

    <h1 class="h1-8xl text-center text-red-500">Lista de Productos</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf{{-- nota 1 --}}
        <table>
            {{-- Filas encabezados tabla --}}
            <tr>
                <th>descripcion Producto</th>
                <th>precio unitario</th>
                <th>categoria</th>
            </tr>
            <tr>
                {{-- Filas inserccion datos --}}
                <td>
                    <input type="text" name="description">
                </td>
                <td>
                    <input type="text" name="unit_price">
                </td>
                <td>
                    <input type="text" name="category">
                </td>
                <td class='py-2 px-4'><input type='submit' name='cr' id='cr' value='Insertar'
                        class='bg-blue-200 text-white px-7 py-2 rounded hover:bg-blue-300'></td>
            </tr>
            {{-- Listado productos ya creados --}}
            @foreach ($products as $product)
                <tr>
                    <td class="text-center">
                        {{ $product->description }}
                    </td>
                    <td class="text-center">
                        {{ $product->unit_price }}
                    </td>
                    <td class="text-center">
                        {{ $product->category }}
                    </td>
                    <!-- boton borrar -->
                    <td class="py-2 px-4">
                        <a href="deleteTask?taskId=<?php echo $task['taskId']; ?>&taskName=<?php echo $task['taskName']; ?>"
                            onclick="return confirmDelete('<?php echo $task['taskName']; ?>');">
                            <input type='button' name='del' id='del' value='Borrar'
                                class='bg-red-500 text-white px-8 py-2 rounded hover:bg-red-300'>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('products.edit', $product->id) }}">{{ $product->description }}</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </form>
    {{ $products->links() }}
@endsection

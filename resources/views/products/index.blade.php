{{-- 
🗒️NOTAS:
1: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
    
    --}}
@extends('layouts.plantilla')

@section('title', 'Productos')

@section('content')

    <h1 class="h1-8xl text-centertext-red-500">Lista de Productos</h1>
    <table>
        {{-- Table header rows --}}
        <tr class="bg">
            <th>descripcion Producto</th>
            <th>precio unitario</th>
            <th>categoria</th>
        </tr>
        <tr>
            {{-- Data insertion rows --}}
            <form action="{{ route('products.store') }}" method="POST">
                @csrf{{-- nota 1 --}}
                <td>
                    <input type="text" name="description">
                </td>
                <td>
                    <input type="text" name="unit_price">
                </td>
                <td>
                    <input type="text" name="category">
                </td>
                <td class='py-2 px-4'><input type='submit' value='Insertar'
                        class='bg-blue-600 text-white px-7 py-2 rounded hover:bg-blue-300'>
                </td>
            </form>
        </tr>
        </form>
        {{-- List products already created --}}
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
                {{-- Delete button --}}
                <td class="py-2 px-4">
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf{{-- nota 1 --}}
                        @method('delete'){{-- nota 2 --}}
                        <button type="submit" onclick="return confirmDelete('{{ $product->description }}')"
                            class='bg-red-500 text-white px-8 py-2 rounded hover:bg-red-300'>Borrar</button>
                    </form>
                </td>
                {{-- Update button --}}
                <td>
                    <a href="{{ route('products.edit', $product->id) }}">
                        <input type='button' name='up' id='up' value='Actualizar'
                            class='bg-yellow-700 text-white px-4 py-2 rounded hover:bg-yellow-500'>
                    </a>
            </tr>
        @endforeach
    </table>
    {{ $products->links() }}
@endsection

<script>
    function confirmDelete(productDescription) {
        return confirm("¿Estás seguro de que deseas borrar el producto: " + productDescription + "?");
    }
</script>

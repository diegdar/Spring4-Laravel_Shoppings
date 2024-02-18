{{-- 
🗒️noteS:
1: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
2: mostrara un mensaje personalizado cuando no se cumpla la validacion del campo    
    --}}
@extends('layouts.plantilla')

@section('title', 'Productos')

@section('content')
<a href="{{ route('home') }}">
    <input type='button' value='Volver a Home'
        class='bg-green-700 text-white px-4 py-2 rounded hover:bg-yellow-500 my-2'>
</a>

    <h1 class="text-6xl text-center text-red-500 my-4">Lista de Productos</h1>
    <table class="flex items-center justify-center">
        {{-- Table header rows --}}
        <tr>
            <th>descripcion Producto</th>
            <th>precio unitario</th>
            <th>categoria</th>
        </tr>
        <tr>
            {{-- Data insertion rows --}}
            <form action="{{ route('products.store') }}" method="POST">
                @csrf{{-- note 1 --}}
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" class="h-9" name="description">
                        @error('description')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" class="h-9" name="unit_price">
                        @error('unit_price')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <select name="category" id="category" class='px-4 py-2 border border-blue-200 rounded'>
                            <option value="--">--Escoje un valor--</option>
                            <option value="Alimentacion">Alimentacion</option>
                            <option value="Limpieza">Limpieza</option>
                            <option value="Higiene personal">Higiene personal</option>
                            <option value="Hogar">Hogar</option>
                        </select>
                        @error('category')
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
                        @csrf{{-- note 1 --}}
                        @method('delete'){{-- note 2 --}}
                        <button type="submit" onclick="return confirmDelete('{{ $product->description }}')"
                            class='bg-red-500 text-white mt-4 px-8 py-2 rounded hover:bg-red-300'>Borrar</button>
                    </form>
                </td class="py-2 px-4">
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

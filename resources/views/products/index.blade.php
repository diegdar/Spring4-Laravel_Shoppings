{{-- 
🗒️noteS:
1: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
2: mostrara un mensaje personalizado cuando no se cumpla la validacion del campo    
    --}}
@extends('layouts.plantilla')

@section('title', 'Productos')

@section('content')

    <h1 class="text-6xl text-center text-red-500 my-4">Lista de Productos</h1>
    <table class="flex items-center justify-center">
        {{-- Table header rows --}}
        <tr>
            <th>Ref. Producto</th>
            <th>Descripcion Producto</th>
            <th>Unidad de medida</th>
            <th>Categoria</th>
        </tr>
        <tr>
            {{-- Data insertion rows --}}
            <form action="{{ route('products.store') }}" method="POST">
                @csrf{{-- note 1 --}}
                <td></td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" class="h-9" name="description" style="text-align: center;"
                            value="{{ old('description') }}">
                        @error('description')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <input type="text" class="h-9" name="measurement_unit" style="text-align: center;"
                            value="{{ old('measurement_unit') }}">
                        @error('measurement_unit')
                            {{-- note 2 --}}
                            <span class="textValidation">*{{ $message }}</span>
                        @enderror
                    </div>
                </td>
                <td>
                    <div class='px-4 py-2 border border-blue-200 rounded flex flex-col'>
                        <select name="category" id="category" class='px-4 py-2 border border-blue-200 rounded'>
                            <option value="--">--Escoje un valor--</option>
                            <option value="Alimentacion" {{ old('category') === 'Alimentacion' ? 'selected' : '' }}>
                                Alimentacion
                            </option>
                            <option value="Limpieza" {{ old('category') === 'Limpieza' ? 'selected' : '' }}>Limpieza
                            </option>
                            <option value="Higiene personal" {{ old('category') === 'Higiene personal' ? 'selected' : '' }}>
                                Higiene personal
                            </option>
                            <option value="Hogar" {{ old('category') === 'Hogar' ? 'selected' : '' }}>Hogar</option>
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
        {{-- List products already created --}}
        @foreach ($products as $product)
            <tr>
                <td class="text-center">
                    {{ $product->id }}
                </td>
                <td class="text-center">
                    {{ $product->description }}
                </td>
                <td class="text-center">
                    {{ $product->measurement_unit }}
                </td>
                <td class="text-center">
                    {{ $product->category }}
                </td>
                {{-- Delete button --}}
                <td class="py-2 px-4">
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf{{-- note 1 --}}
                        @method('delete'){{-- note 2 --}}
                        <button type="submit" onclick="return confirmDelete('{{ $product->id }}')"
                            class='bg-red-500 text-white mt-4 px-8 py-2 rounded hover:bg-red-300'>Borrar</button>
                    </form>
                </td class="py-2 px-4">
                {{-- Update button --}}
                <td>
                    <a href="{{ route('products.edit', $product->id) }}">
                        <input type='button' name='up' id='up' value='Editar'
                            class='bg-yellow-700 text-white px-4 py-2 rounded hover:bg-yellow-500'>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $products->links() }}
@endsection

<script>
    function confirmDelete(idProduct) {
        return confirm("¿Estás seguro de que deseas borrar con la referencia Nº: " + idProduct + "?");
    }
</script>

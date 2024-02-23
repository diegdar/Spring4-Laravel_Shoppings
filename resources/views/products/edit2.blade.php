{{-- 🗒️NOTAS:
1: nombre de la ruta que buscará en  routes\web.php.
2: crea un token oculto para que los usuarios no generen codigo malicioso antes de enviar el formulario.
3: como html no entiende el metodo 'PUT' hay que dejarlo como 'POST' en la lina del form y aqui poner 'PUT' para que laravel entienda que se enviara de esta forma.
4: solo se imprimira este error si hay un error de validacion: ‼️hay que poner dentro el nombre del input, en este caso es 'name', 'descripcion' o 'categoria'.
5: el metodo old() si el usuario cambio el dato original devolvera el primero de sus parametros, pero si no cambio nada devolvera el valor del objeto del registro(su segundo paremtro)  
    
    --}}

    @extends('layouts.plantilla')

    @section('title', 'Cursos edit')
    
    @section('content')
        <h1>En esta pagina podras editar un curso</h1>
        {{-- nota 1 --}}
        <form action="{{ route('cursos.update', $curso->id) }}" method="post">
    
            @csrf {{-- nota 2 --}}
            @method('put')
            {{-- nota 3 --}}

            <table>
                <tr>
                    th
                </tr>
            </table>
        </form>
    
    
    @endsection
    
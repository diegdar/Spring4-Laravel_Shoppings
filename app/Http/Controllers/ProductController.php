<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
/*
🗒️NOTAS:
1: paginate():pagina los registros devueltos. orderBy(): muestra el registro mas reciente primero.
2: view('products..)products es la carpeta donde esta la vista que a su vez estaria en view, e index seria el archivo de la vista.
    compact('products'): es el array que recogemos en la variable $products
3: con el 'id' recupera todos los valores del objeto y nos ahorramos una línea al NO tener que llamar al método find().
5: Esto le pasa el valor de la variable $curso a  la vista. También se puede poner: ['curso'=>$curso].
6: en esta variable $request se guardará todo lo que se envie por un formulario.
7: este metodo mostrará todo el contenido recibido del formulario.
8: StoreCurso es una regla de validacion que se encuentra en la clase StoreCurso del metodo rules() que validará todos valores recogidos en el formulario.
10: enviará los valores recibidos por el formulario a los atributos correspondientes de la clase Curso.
11: guarda los valores en la BBDD.
12: redirect(): redirigirá a la ruta especificada en route(que aparte de la ruta tomará el 'id' del curso creado para saber a que curso redirigir).
13: el $id la recibimos por la URL.
14: $request: rescata los valores actualizados, $curso: rescata los valores anteriores a la actualizacion.
15: Actualiza los datos antiguos por los nuevos.
16: redirect(): redirigirá a la ruta especificada en route(que aparte de la ruta tomará el 'id' del curso creado para saber a que curso redirigir).
17: Asignacion masiva para insertar registros: Crea una instancia de la clase Curso y le pasará los valores recibidos en el formulario a los atributos 'name', 'descripcion' y 'categoria' y ademas guardará estos registros en la BBDD internamente con el metodo save() por lo que es mejor que pasar los datos uno por uno de forma manual(como se muestra en arriba en lo que esta comentado) y se escribe mucho menos codigo. ⚠️para que funcione hay que configurar en la Clase Curso un atributo con el nombre $fillable o $guarded.
18: Asignacion masiva para actualizar: hace practicamente lo mismo que en la nota de arriba(la 17) para utilizar la asignacion masiva pero con el metodo update: este metodo modificará las propiedades del objeto con los datos del formulario y despues de modificar las propiedades internamente ejecuta el metodo save() para actualizarlos tambien en la BBDD.
19: Despues de eliminar redirigirá al usuario al listado de los registros.

*/

class ProductController extends Controller
{
    public function index(){

        $products = Product::orderBy('id', 'desc')->paginate(); //nota 1
        return view('products.products_list', compact('products'));//nota 2

        // return $products;
    }

    public function show(Product $product){//nota 3
        
        return view('products.show', compact('product'));//nota 5
    }
}

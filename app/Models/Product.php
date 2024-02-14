<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
🗒️NOTAS:
1: $guarded actua de una forma parecida a $fillable, pero en lugar de indicarle los campos que debe permitir guardar le indicamos el campo que debe proteger y por tanto no debe guardar si lo recibe por el formulario. 
    ⚠️Si no tenemos un campo para proteger e igual queremos utilizar la asignacion masiva debemos dejar el array vacio.
    
*/

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];//nota 1

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/*
🗒️NOTAS:
1: $guarded acts in a similar way to $fillable, but instead of indicating the fields that should be allowed to be saved, we indicate the field that should be protected and therefore should not be saved if it is received through the form.
     ⚠️If we do not have a field to protect and we still want to use mass assignment, we must leave the array empty.    
2: The name of the function is in plural because we are referencing to many part(Products)
3: Here we set the relation: $this(Purchase) has many products(here we have to put the name of the Class in singular).
*/

class Purchase extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];//note 1

    public function products(): HasMany //note 2
    {
        return $this->hasMany(Product::class);//note 3
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/*
🗒️NOTES:
1: $guarded acts in a similar way to $fillable, but instead of indicating the fields that should be allowed to be saved, we indicate the field that should be protected and therefore should not be saved if it is received through the form.
     ⚠️If we do not have a field to protect and we still want to use mass assignment, we must leave the array empty. 
2: The name of the function is in plural because we are referencing to many part(purchases)

3: Here we set the relation: $this(Product) belongs To one or Many purchases.
*/

class Product extends Model
{
    use HasFactory;

        public $timestamps = false;

    protected $guarded = [];//note 1

    public function purchases():BelongsToMany //note 2
    {
        return $this->belongsToMany(Purchase::class, 'product_purchase');//note 3
    }
}

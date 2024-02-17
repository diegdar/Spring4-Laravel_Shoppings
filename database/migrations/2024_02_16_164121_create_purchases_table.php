<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*
🗒️NOTAS:
1: constrained:
    cascadeOnUpdate(): If the product is updated in the products table it will change in the purchases table as well.
    
*/

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->timestamp('purchase_date');
            $table->integer('quantity');
            $table->decimal('amount');
            $table->string('supermarket', 50);
            $table->foreignId('product_id')
                    ->constrained(table:'products', indexName: 'id')
                    ->cascadeOnUpdate();//note 1
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};

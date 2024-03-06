<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('product_id');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('category_id'); 
            $table->string('admin_id', 6);
            $table->timestamps();

            $table->primary(['admin_id', 'product_id']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

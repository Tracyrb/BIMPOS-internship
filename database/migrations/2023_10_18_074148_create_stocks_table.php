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
        Schema::create('stocks', function (Blueprint $table) {
            $table->integer('stock_id');
            $table->string('user_id', 6);
            $table->unsignedBigInteger('product_id');
            $table->string('admin_id', 6);
            $table->integer('quantity');
            $table->timestamps();

            $table->primary(['admin_id', 'stock_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};

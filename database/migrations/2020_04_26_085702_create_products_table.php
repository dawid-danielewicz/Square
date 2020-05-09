<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('id_wholesale');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('color');
            $table->string('pattern');
            $table->integer('quantity');
            $table->float('brutto_price');
            $table->float('netto_price');
            $table->float('price_per_piece');
            $table->integer('in_store');
            $table->foreignId('wholesale_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

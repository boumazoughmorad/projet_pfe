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
            $table->foreignId('producer_id')
            ->constrained('producers')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('categorie_id')
            ->constrained('categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');
          /*  $table->foreignId('stock_id')
            ->constrained('stocks')
            ->onDelete('cascade')
            ->onUpdate('cascade');*/
            $table->string('name');
            $table->string('image_path')->nullable();
            $table->text('description');
            $table->integer('quantite');
            $table->integer('quantite_commander')->nullable();
            $table->double('prix',8,3);
            $table->boolean('statu')->default(false);
            $table->boolean('valid')->default(false);
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

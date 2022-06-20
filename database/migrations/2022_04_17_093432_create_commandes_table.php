<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
            ->constrained('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        //    $table->foreignId('distriduter_id')
        //     ->constrained('distributers')
        //     ->onDelete('cascade')
        //     ->onUpdate('cascade');
        //     $table->text('quantity');
            
            $table->foreignId('products_id')
            ->constrained('products')
            ->onDelete('cascade')
            ->onUpdate('cascade');;
            // $table->text('date_orders')->nullable();;
            $table->integer('prix_totale');
            $table->integer('quantity');
            
            $table->softDeletes()->nullable();;
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
        Schema::dropIfExists('commandes');
    }
}

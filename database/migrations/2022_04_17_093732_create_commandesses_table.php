<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandesses', function (Blueprint $table) {
            $table->id();
           
            $table->foreignId('distrubiteur_id')
            ->constrained('distributers')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('panier_id')
            ->constrained('commandes')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            // $table->foreignId('client_id')
            // ->constrained('users')
            // ->onDelete('cascade')
            // ->onUpdate('cascade');
            $table->double('prix_totale_orders');
            $table->string('report')->nullable();
          
            // $table->string('report')->nullable();
            $table->string('statu')->nullable();
            $table->string('transport')->nullable();
            $table->string('date_orders')->nullable();
            $table->string('date_livraison')->nullable();

            // $table->timestamps('deleted_at')->nullable();

            $table->timestamps();
            $table->softDeletes()->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandesses');
     

    }
}

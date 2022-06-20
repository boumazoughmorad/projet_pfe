<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piements', function (Blueprint $table) {
            $table->id();

            $table->string('postCode');
            $table->string('paymentMethod');
            $table->integer('couponCode');
            $table->foreignId('user_id')
            ->constrained('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('piements');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('description')->nullable();
            $table->string('password');
            $table->string('image_path')->nullable();
            $table->string('address')->nullable();
            $table->integer('num_tele')->nullable();
            // $table->boolean('disponible')->default(true);
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
        Schema::dropIfExists('distributers');
    }
}

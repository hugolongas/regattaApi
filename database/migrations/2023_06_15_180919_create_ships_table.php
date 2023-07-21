<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->id()->autoIncrement();;
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->integer('initial_crew')->default(6);
            $table->integer('current_crew')->default(0);
            $table->integer('max_crew')->default(6);
            $table->double('speed');
            $table->double('acceleration');
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
        Schema::dropIfExists('ships');
    }
}

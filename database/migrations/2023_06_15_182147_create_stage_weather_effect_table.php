<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStageWeatherEffectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stage_weather_effect', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('stage_id')->constrained('stages');
            $table->foreignId('weather_effect_id')->constrained('weather_effects');
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
        Schema::dropIfExists('stage_weather_effect');
    }
}

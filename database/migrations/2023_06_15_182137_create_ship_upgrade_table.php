<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipUpgradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_upgrade', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('ship_id')->constrained('ships');
            $table->foreignId('upgrade_id')->constrained('upgrades');
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
        Schema::dropIfExists('ship_upgrade');
    }
}

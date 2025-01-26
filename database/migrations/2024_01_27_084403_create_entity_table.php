<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('health_points');
            $table->integer('health_points_max');
            $table->integer('power');
            $table->integer('initiative');
            $table->integer('intelligence');
            $table->integer('lvl');
            $table->integer('protection');
            $table->integer('user_id')->index()->unsigned()->default(1);
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
        Schema::dropIfExists('entities');
    }
}

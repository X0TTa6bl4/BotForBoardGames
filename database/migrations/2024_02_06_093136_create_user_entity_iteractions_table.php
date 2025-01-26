<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEntityIteractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_entity_interactions', function (Blueprint $table) {
            $table->integer('user_id')->index()->unsigned()->default(1);
            $table->integer('entity_id')->index()->unsigned()->default(1);
            $table->string('interaction_type')->default('default');
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
        Schema::dropIfExists('user_entity_interactions');
    }
}

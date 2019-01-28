<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscordRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discord_roles', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('name');
            $table->integer('color');
            $table->boolean('hoist');
            $table->integer('position');
            $table->integer('permissions');
            $table->boolean('managed');
            $table->boolean('mentionable');
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discord_roles');
    }
}

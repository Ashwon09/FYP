<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('game_name');
            $table->string('game_developer');
            $table->String('game_description', 1000);
            $table->integer('game_price');
            $table->string('game_image')->nullable();
            $table->string('game_comment')->nullable();
            $table->enum('game_status', ['sold', 'selling'])->default('selling');

            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->bigInteger('console_id')->unsigned()->index()->nullable();
            $table->foreign('console_id')
                ->references('id')
                ->on('consoles')
                ->onDelete('set null');

            $table->String('genre_id');
            

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
        Schema::dropIfExists('items');
    }
}

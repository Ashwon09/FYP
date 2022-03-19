<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_by')->unsigned()->index()->nullable();
            $table->foreign('report_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                
            $table->bigInteger('report_to')->unsigned()->index()->nullable();
            $table->foreign('report_to')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->bigInteger('report_game')->unsigned()->index()->nullable();
            $table->foreign('report_game')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');

            $table->string('report_reason');
            $table->string('report_comment')->nullable();
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
        Schema::dropIfExists('reports');
    }
}

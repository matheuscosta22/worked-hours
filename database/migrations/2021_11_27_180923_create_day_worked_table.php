<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayWorkedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_worked', function (Blueprint $table) {
            $table->id();
            $table->timestamp('started_at');
            $table->timestamp('break')->nullable();
            $table->timestamp('return')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->foreignId('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('day_worked');
    }
}

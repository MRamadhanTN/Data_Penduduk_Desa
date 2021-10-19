<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->nullable();
            $table->string('name');
            $table->string('gender');
            $table->string('NIK');
            $table->string('place_birth');
            $table->string('birth_date');
            $table->string('job');
            $table->string('religion');
            $table->string('citizenship');
            $table->date('date');
            $table->time('time');
            $table->integer('age');
            $table->string('place');
            $table->text('penyebab')->nullable();

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
        Schema::dropIfExists('dies');
    }
}

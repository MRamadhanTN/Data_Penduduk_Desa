<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBirthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('births', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->nullable();
            $table->string('name');
            $table->string('father')->nullable();
            $table->string('mother');
            $table->string('gender');
            $table->string('place_birth');
            $table->string('birth');
            $table->integer('weight');
            $table->integer('width');
            $table->foreignId('family_id')->nullable();
            $table->foreignId('detail_id')->nullable();

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
        Schema::dropIfExists('births');
    }
}

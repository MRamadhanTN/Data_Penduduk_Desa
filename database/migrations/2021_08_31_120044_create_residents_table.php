<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('NIK')->unique()->nullable();
            $table->string('name');
            $table->string('place_birth');
            $table->date('birth');
            $table->foreignId('job_id')->nullable();
            $table->string('job');
            $table->enum('gender', ['Pria', 'Wanita']);
            $table->integer('RT');
            $table->integer('RW');
            $table->text('address');
            $table->foreignId('provinces_id')->nullable();
            $table->string('provinces');
            $table->foreignId('regencies_id')->nullable();
            $table->string('regencies');
            $table->foreignId('districts_id')->nullable();
            $table->string('districts');
            $table->foreignId('villages_id')->nullable();
            $table->string('villages');
            $table->enum('religion',['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu','Atheis']);
            $table->enum('status',['Pelajar','Menikah','Cerai Mati','Cerai Hidup']);
            $table->enum('education',['SD','SMP','SMA','D1','D2','D3','D4','S1','S2','S3'])->nullable();
            $table->enum('blood_group',['A','B','AB','O'])->nullable();
            $table->enum('kewarganegaraan',['WNI','WNA']);
            $table->enum('category',['Penduduk Tetap', 'Penduduk Pindah', 'Penduduk Datang'])->nullable();
            $table->foreignId('family_id')->nullable();
            $table->string('kepala_keluarga')->nullable();
            $table->string('no_kk')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('residents');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname')->nullable();
            $table->string('nombres');
            $table->string('aPaterno');
            $table->string('aMaterno');
            $table->date('fecNacimiento');
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->integer('career_id')->unsigned()->nullable();
            $table->foreign('career_id')->references('id')->on('career')->onDelete('set null');    
            $table->text('foto')->nullable();     
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');       
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('slug'); //serán con nombre + random
            $table->text('descripcion');
            $table->string('precio');
            $table->text('foto');
            $table->string('tiempoReferencial');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade'); //dueño del material
            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('state')->onDelete('cascade');
            $table->integer('condition_id')->unsigned();
            $table->foreign('condition_id')->references('id')->on('condition')->onDelete('cascade');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('material_career', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('material_id')->unsigned()->index();
            $table->foreign('material_id')->references('id')->on('material')->onDelete('cascade');

            $table->integer('career_id')->unsigned()->index();
            $table->foreign('career_id')->references('id')->on('career')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('material_category', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('material_id')->unsigned()->index();
            $table->foreign('material_id')->references('id')->on('material')->onDelete('cascade');

            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');

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
        Schema::dropIfExists('material');
    }
}

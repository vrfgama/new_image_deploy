<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->string('size', 10);
            $table->string('extension', 4);
            $table->string('width', 10);
            $table->string('heigth', 10);
            $table->string('deploy_id')->nullable();

            $table->string('path')->nullable();

            $table->dateTime('created_at')->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}

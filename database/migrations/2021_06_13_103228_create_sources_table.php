<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();

           // $table->string('id', 30);
            $table->text('name');
            $table->string('url');
            $table->string('category');
            $table->string('language', 2);
            $table->string('country', 2);
//            $table->string('NG_Description');
//            $table->string('NG_Review');
            $table->timestamps();

           // $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sources');
    }
}

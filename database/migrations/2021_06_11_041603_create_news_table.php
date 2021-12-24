<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publisher_id');
            $table->foreign('publisher_id')->references('id')->on('publishers')
                ->onDelete('cascade');
            $table->string("author")->default("");
            $table->string("title")->default("");
            $table->string("description")->default("");
            $table->string("url")->default("");
            $table->string("urlToImage")->default("");
            $table->string("publishedAt")->default("");
            $table->string("content")->default("");
            $table->string("lang")->default("ar");
            $table->string("country")->default("su");



            $table->timestamps("publishedAt");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}

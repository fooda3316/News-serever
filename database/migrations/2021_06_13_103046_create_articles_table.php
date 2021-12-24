<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('source_id', 30);
            $table->string('author')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('url');
            $table->string('urlToImage');
            $table->timestamp('publishedAt');
            $table->string('content');
//            $table->string('NG_Description');
//            $table->string('NG_Review');
          //  $table->timestamps();

            $table->foreign('source_id')->references('id')->on('sources');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

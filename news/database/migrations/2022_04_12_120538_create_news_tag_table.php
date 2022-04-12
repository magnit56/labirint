<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('news_tag', function (Blueprint $table) {
            $table->foreignId('news_id')->references('id')->on('news');
            $table->foreignId('tag_id')->references('id')->on('tags');
            $table->unique(['news_id', 'tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_tag');
    }
};

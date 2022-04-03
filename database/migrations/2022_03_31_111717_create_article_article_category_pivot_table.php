<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleArticleCategoryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_article_category', function (Blueprint $table) {
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id', 'article_id_fk_6333537')->references('id')->on('articles')->onDelete('cascade');
            $table->unsignedBigInteger('article_category_id');
            $table->foreign('article_category_id', 'article_category_id_fk_6333537')->references('id')->on('article_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_article_category_pivot');
    }
}

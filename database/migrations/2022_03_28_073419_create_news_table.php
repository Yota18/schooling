<?php

use App\Models\NewsCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignIdFor(NewsCategory::class, 'news_category_id');
            $table->foreign('news_category_id')->references('id')->on('news_categories')->onDelete('cascade');
            $table->string('title',200);
            $table->longText('description');
            $table->string('image');
            $table->string('type')->nullable();
            $table->string('slug');
            $table->timestamp('date');
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
        Schema::dropIfExists('news');
    }
};

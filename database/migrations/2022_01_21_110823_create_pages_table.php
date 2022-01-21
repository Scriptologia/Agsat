<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('name_uk')->nullable();
            $table->string('description_ru')->nullable();
            $table->string('description_uk')->nullable();
            $table->json('tags_ru')->nullable();
            $table->json('tags_uk')->nullable();
            $table->text('text_ru')->nullable();
            $table->text('text_uk')->nullable();
            $table->boolean('visible')->default(1);
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
        Schema::dropIfExists('pages');
    }
}

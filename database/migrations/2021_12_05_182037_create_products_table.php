<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable() ->constrained('categories')->onDelete('set null');
            $table->string('slug')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('name_uk')->nullable();
            $table->string('description_ru')->nullable();
            $table->string('description_uk')->nullable();
            $table->json('tags_ru')->nullable();
            $table->json('tags_uk')->nullable();
            $table->string('text_ru')->nullable();
            $table->string('text_uk')->nullable();

            $table->integer('count')->default(0);
            $table->integer('price')->default(0);
            $table->foreignId('curs')->nullable() ->constrained('curs')->onDelete('set null');
            $table->integer('skidka')->default(0);
            $table->json('img')->nullable();
            $table->boolean('visible')->default(1);
            $table->enum('type', ['product', 'page']);
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
        Schema::dropIfExists('products');
    }
}

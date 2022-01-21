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
            $table->text('text_ru')->nullable();
            $table->text('text_uk')->nullable();

            $table->integer('count')->default(0);
            $table->float('skidka',11,2)->default(0.00);
            $table->float('price',11,2)->default(0.00);
            $table->foreignId('curs_id')->nullable() ->constrained('curs')->onDelete('set null');
            $table->json('img')->nullable();
            $table->json('dop_products')->nullable();
            $table->boolean('visible')->default(1);
            $table->enum('type', ['product', 'page'])->default('product');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru')->nullable();
            $table->string('name_uk')->nullable();
            $table->text('text_ru')->nullable();
            $table->text('text_uk')->nullable();
            $table->float('price',11,2)->default(0.00);
            $table->foreignId('curs_id')->nullable() ->constrained('curs')->onDelete('set null');
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
        Schema::dropIfExists('services');
    }
}

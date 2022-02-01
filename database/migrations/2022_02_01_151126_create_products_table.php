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
            $table->integer('category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->decimal('original_price')->default('0');
            $table->decimal('selling_price')->default('0');
            $table->string('image')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('tax')->default('0');
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('trending')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
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

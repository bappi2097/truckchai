<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('b_product_category_id');
            $table->string('name')->nullable();
            $table->text('category')->nullable();
            $table->text('model')->nullable();
            $table->text('manufacture_date')->nullable();
            $table->text('mileage')->nullable();
            $table->text('power')->nullable();
            $table->text('manufacture_country')->nullable();
            $table->text('image')->nullable();
            $table->double('price')->nullable();
            $table->text('case')->nullable();
            $table->text('specification')->nullable();
            $table->integer('quantity')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_sale')->default(1); // sale or rent
            $table->foreignId('created_by');
            $table->softDeletes();
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
        Schema::dropIfExists('b_products');
    }
}

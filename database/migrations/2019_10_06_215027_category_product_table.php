<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->comment('ID категории');
            $table->integer('product_id')->unsigned()->comment('ID товара');

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unique(['category_id', 'product_id'], 'category_product_category_id_product_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_product', function (Blueprint $table) {
            $table->dropForeign(['category_id', 'product_id']);
            $table->dropIndex('category_product_category_id_product_id_unique');
        });

        Schema::drop('category_product');
    }
}

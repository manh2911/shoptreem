<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTableImageDetailProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('image_detail_products', function(Blueprint $table) {
            $table->dropColumn('detail_product_id');
            $table->integer('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('image_detail_products', function(Blueprint $table) {
            $table->integer('detail_product_id');
            $table->dropColumn(['product_id']);
        });
    }
}

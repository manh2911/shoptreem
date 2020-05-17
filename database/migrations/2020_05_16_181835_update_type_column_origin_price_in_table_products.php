<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateTypeColumnOriginPriceInTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('alter table products modify origin_price DOUBLE(15,2) DEFAULT 0');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_products', function (Blueprint $table) {
            DB::statement('alter table products modify origin_price DOUBLE(8,2) DEFAULT 0');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrandToProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->string('brand_id')->references('id')->on('brand')->onDelete('cascade');
            $table->string('category_id')->references('id')->on('category')->onDelete('cascade');
        });
    }
}
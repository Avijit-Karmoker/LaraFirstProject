<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('product_name');
            $table->integer('vendor_id');
            $table->integer('category_id');
            $table->float('purchase_price', 8, 2);
            $table->float('regular_price', 8, 2);
            $table->float('discounted_price', 8, 2)->nullable();
            $table->longText('description');
            $table->text('short_description')->nullable();
            $table->LongText('additional_discription')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
            $table->softDeletes()->nullable();
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
};

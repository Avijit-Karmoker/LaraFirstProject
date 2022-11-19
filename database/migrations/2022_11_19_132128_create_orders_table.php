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
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id',11);
            $table->string('name',255)->nullable();
            $table->string('email',30)->nullable();
            $table->string('phone',20)->nullable();
            $table->double('amount')->nullable();
            $table->text('address');
            $table->string('status',10)->nullable();
            $table->string('transaction_id',255)->nullable();
            $table->string('currency',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

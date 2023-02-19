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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('code_trx')->unique();
            $table->string('product_code');
            $table->foreign('product_code')->references('product_code')->on('products');
            $table->integer('qty');
            $table->double('total');
            $table->text('description')->nullable();
            $table->foreignId('supplier_id');
            $table->date('date_trx');
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
        Schema::dropIfExists('purchases');
    }
};

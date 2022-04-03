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
            $table->id();
            $table->string('order_no');
            $table->string('box_id')->nullable();
            $table->json('items')->nullable();
            $table->date('date')->nullable();
            $table->string('picking_product')->nullable();
            $table->double('amount',18,2);
            $table->string('shipping_company')->nullable();
            $table->string('shipping_tracking_number')->nullable();
            $table->string('shipping_label')->nullable();
            $table->string('status')->default('ORDER_RECEIVED');
            $table->timestamps();
            $table->softDeletes();
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

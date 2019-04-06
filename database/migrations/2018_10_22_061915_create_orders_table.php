<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('payment_id');
            $table->integer('shipper_id');
            $table->integer('address_delivery_id');
            $table->integer('transaction_status');
            $table->date('ship_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->integer('total_price');
//            $table->date('required_date')->default(\Carbon\Carbon::today()->addDays(3));
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
        Schema::dropIfExists('orders');
    }
}

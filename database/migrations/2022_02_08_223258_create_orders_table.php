<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->string('contact');

            $table->string('phone');
           
            $table->enum('status', [Order::PENDIENTE, Order::RECIBIDO, Order::ENVIADO, Order::ENTREGADO, Order::ANULADO])->default(Order::PENDIENTE);
            
            $table->enum('envio_type', [1 ,2]);
            
            //Lo defino porque puede variar con el tiempo
            $table->float('shipping_cost');

            $table->float('total');

            $table->longText('content')->nullable();

            $table->unsignedBigInteger('city_id')->nullable();
           
            $table->unsignedBigInteger('department_id')->nullable();
           
            $table->unsignedBigInteger('district_id')->nullable();
           
            $table->string('address')->nullable();

            $table->string('references')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('district_id')->references('id')->on('districts');
            
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

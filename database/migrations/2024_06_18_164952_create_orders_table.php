<?php

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
            $table->unsignedBigInteger('wisata_id');
            $table->integer('quantity');
            $table->date('visit_date'); // Mengganti integer menjadi string
            $table->enum('status', ['paid', 'unpaid']);
            $table->integer('total_price');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('wisata_id')->references('id')->on('wisatas')->onDelete('cascade');; 
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

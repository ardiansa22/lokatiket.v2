<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhislistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whislists', function (Blueprint $table) {
$table->id();
    $table->unsignedBigInteger('user_id');   // user yang menambahkan wishlist (customer)
    $table->unsignedBigInteger('wisata_id'); // wisata yang ditambahkan ke wishlist
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('wisata_id')->references('id')->on('wisatas')->onDelete('cascade');

    $table->unique(['user_id', 'wisata_id']); // supaya tidak ada duplikat wishlist
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whislists');
    }
}

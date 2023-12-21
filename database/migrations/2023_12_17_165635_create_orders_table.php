<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_menu');
            $table->integer('jumlah');
            $table->decimal('total_harga');
            $table->timestamps();

            $table->foreign('id_customer')->references('id_customer')->on('customers');
            $table->foreign('id_menu')->references('id_menu')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

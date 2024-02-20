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
        Schema::create('pay_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name_order');
            $table->string('date_order');
            $table->string('detail_order');
            $table->integer('total_order');
            $table->integer('status_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_orders');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('receiver');
            $table->string('address');
            $table->string('phone');
            $table->dateTime('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_date')->nullable();
            $table->integer('status')->default(0);
            $table->integer('payment_status')->default(0)->nullable();
            $table->string('tracking_code')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('payment_method_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('restrict');
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

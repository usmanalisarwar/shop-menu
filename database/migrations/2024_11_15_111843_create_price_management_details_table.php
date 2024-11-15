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
        Schema::create('price_management_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price_management_id')->nullable();
            $table->foreign('price_management_id')->references('id')->on('price_management')->onDelete('cascade');
            $table->string('label')->nullable();
            $table->string('order_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_management_details');
    }
};

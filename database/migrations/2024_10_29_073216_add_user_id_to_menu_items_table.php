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
        Schema::table('menu_items', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('description')->nullable()->after('price');
            $table->boolean('availability_status')->default(true)->after('description'); // Available or not  
            $table->integer('prep_time')->default(0)->after('availability_status'); // Preparation time in minutes  
            $table->decimal('discount', 5, 2)->default(0)->after('prep_time'); // Discount amount (e.g., 10% discount)  
            $table->string('size')->nullable()->after('discount'); // Small, Medium, Large, etc.  
            $table->unsignedInteger('order_count')->default(0)->after('size'); // Number of times item has been ordered   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('description');
            $table->dropColumn('availability_status');
            $table->dropColumn('prep_time');
            $table->dropColumn('discount');
            $table->dropColumn('size');
            $table->dropColumn('order_count'); 
 
        });
    }
};

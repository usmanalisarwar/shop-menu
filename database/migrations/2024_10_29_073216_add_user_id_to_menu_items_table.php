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
            $table->integer('quantity')->default(0)->after('description'); 
            $table->integer('pieces')->default(1)->after('quantity');
            $table->enum('plate_type', ['half', 'full'])->default('full')->after('pieces');
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
            $table->dropColumn('quantity');
            $table->dropColumn('pieces');
            $table->dropColumn('plate_type'); 
        });
    }
};

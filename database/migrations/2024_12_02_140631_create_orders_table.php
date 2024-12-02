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
            $table->id();
            $table->foreignId("restaurant_id")->constrained()->after("id");
            $table->decimal('total_price', 8, 2);
            $table->string('firstname', 255);
            $table->string('lastname', 255);
            $table->string('address', 255);
            $table->string('phone_number', 255);
            $table->text('note');
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

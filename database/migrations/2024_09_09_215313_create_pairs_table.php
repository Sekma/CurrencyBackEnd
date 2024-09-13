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
        Schema::create('pairs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('currency_1_id');
            $table->unsignedInteger('currency_2_id');

            $table->foreign('currency_1_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('currency_2_id')->references('id')->on('currencies')->onDelete('cascade');

            $table->decimal('exchange');
            $table->integer('conversions')->default(0);
            $table->unique(['currency_1_id', 'currency_2_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pairs');
    }
};

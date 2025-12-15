<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->decimal('price', 15, 3)->index();
            $table->decimal('rating', 2, 1)->index();
            $table->string('image')->nullable();
            $table->unsignedBigInteger(column: 'currency_id');
            $table->json('currency');
            $table->unsignedBigInteger(column: 'created_by');
            $table->unsignedBigInteger(column: 'updated_by')->nullable();
            $table->unsignedBigInteger(column: 'deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

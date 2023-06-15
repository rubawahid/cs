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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug')->nullable();
            //table->unsignedBigInteger('category_id)->nulable();
            $table->text('description')->nullable();
            $table->text('short_descriptions')->nullable();
            $table->float('price')->default(0);
            $table->string('compare_price')->nullable();
            $table->string('image_url')->nullable();
            $table->enum('statuss', ['draft', 'active', 'archived'])->default('active');
            $table->timestamps();
            // $table->foreign('category_id')->references('id')->on('categories')->nullOfDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories', 'id')->nullOnDelete();
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

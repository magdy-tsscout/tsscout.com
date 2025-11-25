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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text(column: 'meta_author')->nullable();
            $table->string('slug')->unique();
            $table->string('content_header');
            $table->string('content_subheader');
            $table->string('header_1'); // Header for the first section
            $table->text('paragraph_1'); // Paragraph for the first section
            $table->string('image_1'); // Image URL for the first section
            $table->string('header_2')->nullable();
            $table->text('paragraph_2')->nullable();
            $table->string('image_2')->nullable();
            $table->string('header_3')->nullable();
            $table->text('paragraph_3')->nullable();
            $table->string('image_3')->nullable();
            $table->string('header_4')->nullable();
            $table->text('paragraph_4')->nullable();
            $table->string('image_4')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};

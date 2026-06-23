<?php

use App\Models\SellersDictionaryHome;
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
        Schema::create('sellers_dictionary_homes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->timestamps();
        });
        SellersDictionaryHome::create([
            'title' => 'Welcome to the Sellers Dictionary',
            'content' => 'This is the default content for the Sellers Dictionary home page. You can edit this content from the admin panel.',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers_dictionary_homes');
    }
};

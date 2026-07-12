<?php

use App\Models\Blog;
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
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('podcast_url')->nullable()->after('content');
            $table->string('blog_type')->default('blog')->after('podcast_url');
        });
        Blog::where('image', null)->update(['blog_type' => 'blog']);
        Blog::where('video_url', null)->update(['blog_type' => 'tutorial']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('podcast_url');
        });
    }
};

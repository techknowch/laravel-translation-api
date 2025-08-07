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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('key')->unique();
            $table->text('content');
            $table->unsignedBigInteger('language_id');
            $table->json('tags')->nullable();
            $table->string('tag_value')->nullable()->storedAs('JSON_UNQUOTE(JSON_EXTRACT(tags, "$[0]"))');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->index(['language_id', 'key'], 'translations_language_key_index');
            $table->index(['language_id', 'tag_value'], 'translations_language_tags_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};

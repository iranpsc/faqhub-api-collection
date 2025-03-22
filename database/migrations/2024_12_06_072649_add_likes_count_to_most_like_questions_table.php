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
        Schema::table('most_like_questions', function (Blueprint $table) {
            $table->unsignedBigInteger('likes_count')->after('question_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('most_liked_questions', function (Blueprint $table) {
            //
        });
    }
};

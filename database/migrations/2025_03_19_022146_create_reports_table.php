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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('comment_id')->nullable()->constrained('comments','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('reply_id')->nullable()->constrained('replies','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('post_id')->nullable()->constrained('posts','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('type_id')->constrained('report_types','id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

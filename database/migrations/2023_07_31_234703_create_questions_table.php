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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('body', 1000)->nullable(false);
            $table->string('image')->nullable()->default(NULL);
            $table->integer('age');
            $table->unsignedBigInteger('topic_id');
            $table->softDeletes();
            $table->foreign('topic_id')->on('topics')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};

<?php

declare(strict_types=1);

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
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('');
            $table->string('slug')->default('');
            $table->string('summary')->default('');
            $table->text('content')->nullable();
            $table->integer('weight')->default(0);
            $table->unsignedTinyInteger('status')->default(1)->comment('1=active, 0=suspended');
            $table->unsignedBigInteger('author_id')->default(0);
            $table->unsignedBigInteger('featured_image_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};

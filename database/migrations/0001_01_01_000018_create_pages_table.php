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
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('');
            $table->string('slug')->nullable()->unique();
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('featured_image_id')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1=active, 0=suspended');
            $table->timestamps();
            $table->softDeletes();

            $table->index('deleted_at', 'idx_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

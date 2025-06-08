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
        Schema::create('navigations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->default('');
            $table->string('url')->default('');
            $table->tinyInteger('is_active')->default(1)->comment('0: inactive, 1: active');

            $table->integer('parent_id')->default(-1);
            $table->integer('weight')->default(0);
            $table->softDeletes();

            $table->index('parent_id');
            $table->index('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigations');
    }
};

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
        Schema::create('site_navigations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->default('');
            $table->string('path');
            $table->string('controller_action')->nullable();
            $table->json('route_parameters')->nullable();
            $table->json('child_routes')->nullable();

            $table->tinyInteger('is_active')->default(1)->comment('0: inactive, 1: active');
            $table->tinyInteger('is_visible')->default(1)->comment('0: hidden, 1: visible');

            $table->integer('parent_id')->default(-1);
            $table->integer('weight')->default(0);

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
        Schema::dropIfExists('site_navigations');
    }
};

<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create(config('ban.table', 'bans'), function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('bannable');
            $table->nullableMorphs('created_by');
            $table->text('comment')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->json('metas')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->index('ip');
            $table->index('expired_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('ban.table', 'bans'));
    }
};

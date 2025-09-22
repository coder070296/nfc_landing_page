<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('visits', function (Blueprint $t) {
            $t->id();
            $t->foreignId('card_id')->constrained()->cascadeOnDelete();
            $t->string('ip', 45)->nullable();        // IPv4/IPv6
            $t->text('user_agent')->nullable();
            $t->text('referrer')->nullable();
            $t->timestamp('created_at')->useCurrent();  // no updated_at
        });
    }
    public function down(): void {
        Schema::dropIfExists('visits');
    }
};


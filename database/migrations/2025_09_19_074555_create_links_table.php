<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('links', function (Blueprint $t) {
            $t->id();
            $t->foreignId('card_id')->constrained()->cascadeOnDelete();
            $t->string('label');       // e.g., "WhatsApp", "Website"
            $t->string('url');         // full URL or wa.me/...
            $t->unsignedInteger('order')->default(0);
            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('links');
    }
};

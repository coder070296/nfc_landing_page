<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cards', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->string('slug')->unique();
            $t->string('display_name');
            $t->string('title')->nullable();
            $t->text('bio')->nullable();
            $t->string('avatar_path')->nullable();

            $t->string('whatsapp')->nullable();
            $t->string('phone')->nullable();
            $t->string('email_public')->nullable();
            $t->string('website')->nullable();
            $t->string('instagram')->nullable();
            $t->string('linkedin')->nullable();
            $t->string('x_handle')->nullable();

            $t->boolean('is_active')->default(true);
            $t->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('cards');
    }
};

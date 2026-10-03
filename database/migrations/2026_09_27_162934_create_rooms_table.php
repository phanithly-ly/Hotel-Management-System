<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();
            $table->foreignId('room_type_id')
                  ->constrained('room_types')
                  ->onDelete('cascade');            // លុប room_type → លុប room ដែលពាក់ព័ន្ធ
            $table->integer('floor')->nullable();
            $table->enum('status', ['available', 'occupied', 'maintenance'])
                  ->default('available');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
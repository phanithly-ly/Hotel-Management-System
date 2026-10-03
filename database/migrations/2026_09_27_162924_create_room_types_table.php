<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name');           // ឧ. Standard, Deluxe, Suite
            $table->decimal('price_per_night', 10, 2);
            $table->integer('capacity');            // ចំនួនភ្ញៀវអតិបរមា
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
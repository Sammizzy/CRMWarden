<?php

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
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->after('id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('category');
            $table->string('description');
            $table->integer('priority')->default(1);
            $table->string('status')->default('WIP');
            $table->string('assigned_to') ->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('lists');
    }
};

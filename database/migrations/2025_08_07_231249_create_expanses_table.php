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
        Schema::create('expanses', function (Blueprint $table) {
            $table->id();

            $table->foreignId("supplier_id")->nullable()->constrained()->onDelete("set null");
            $table->foreignId("user_id")->nullable()->constrained()->onDelete("set null");
            $table->string("title");
            $table->decimal("amount", 6, 2);
            $table->date("date")->nullable();
            $table->text("description")->nullable();
            $table->string("category");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expanses');
    }
};

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
        Schema::create('warehouse_changes', function (Blueprint $table) {
			$table->id();
			$table->foreignId('warehouse_item_id')->constrained()->cascadeOnDelete();
			$table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
			$table->double('change');
			$table->string('note')->nullable();
			$table->time('time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_changes');
    }
};

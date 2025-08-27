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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->unsignedBigInteger('officer_id')->nullable();
            $table->integer('nominal');
            $table->enum('period', ['mingguan','bulanan','tahunan']);
            $table->date('due_date');
            $table->string('periode_tagihan')->nullable();
            $table->integer('qty')->default(1);
            $table->foreignId('dues_category_id')->constrained('dues_categories')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

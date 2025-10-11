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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained('leads')->onDelete('cascade');
            $table->string('Service');
            $table->string('Bank');
            $table->string('Card_Type');
            $table->decimal('Charge', 10, 2);
            $table->decimal('Swipe_Amt', 10, 2);
            $table->string('Swipe_Mode');
            $table->decimal('Payment', 10, 2);
            $table->string('Pay_Mode');
            $table->decimal('Charge_Amt', 10, 2);
            $table->decimal('Short', 10, 2)->nullable();
            $table->decimal('receivable', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

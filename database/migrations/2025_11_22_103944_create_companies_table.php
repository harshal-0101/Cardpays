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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('Comp_Name');
            $table->string('Comp_Address')->nullable();
            $table->string('Comp_State')->nullable();
            $table->string('Comp_Country')->nullable();
            $table->string('Comp_Email')->nullable();
            $table->string('Comp_Phone')->nullable();
            $table->string('Comp_Website')->nullable();
            $table->string('Comp_Tax_Number')->nullable();
            $table->string('Comp_Vat_Number')->nullable();
            $table->string('Comp_Reg_Number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

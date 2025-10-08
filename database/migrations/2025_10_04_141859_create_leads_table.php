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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Mobile');
            $table->string('City');
            $table->string('Cards');
            $table->decimal('Total_Bill', 10, 2);
            $table->string('Stage');
            $table->string('Source');
            $table->integer('Due_Days');
            $table->string('Owner');
            $table->string('Created_By');
            $table->timestamps();

            $table->check('Mobile REGEXP "^[0-9]+$"');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

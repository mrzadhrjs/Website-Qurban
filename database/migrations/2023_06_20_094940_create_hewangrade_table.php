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
        Schema::create('hewangrade', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hewan_id')->unsigned();
            $table->bigInteger('grade_id')->unsigned();
            $table->timestamps();
            $table->foreign('hewan_id')->references('id')->on('hewan')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hewangrade');
    }
};

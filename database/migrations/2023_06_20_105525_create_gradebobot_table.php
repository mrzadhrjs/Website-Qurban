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
        Schema::create('gradebobot', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('grade_id')->unsigned();
            $table->bigInteger('bobot_id')->unsigned();
            $table->timestamps();
            $table->foreign('grade_id')->references('id')->on('grade')->onDelete('cascade');
            $table->foreign('bobot_id')->references('id')->on('bobot')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gradebobot');
    }
};

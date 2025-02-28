<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('mesas', function (Blueprint $table) {
        $table->id();
        $table->string('nombre'); // Número o nombre de la mesa
        $table->enum('status', ['libre', 'ocupada'])->default('libre');
        $table->unsignedBigInteger('mesero_id')->nullable();
        $table->foreign('mesero_id')->references('id')->on('meseros')->onDelete('set null');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesas');
    }
};

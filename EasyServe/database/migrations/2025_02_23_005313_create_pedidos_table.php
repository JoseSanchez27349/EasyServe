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
    Schema::create('pedidos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('mesa_id');
        $table->unsignedBigInteger('mesero_id');
        $table->decimal('total', 8, 2)->default(0);
        $table->timestamps();

        $table->foreign('mesa_id')->references('id')->on('mesas')->onDelete('cascade');
        $table->foreign('mesero_id')->references('id')->on('meseros')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

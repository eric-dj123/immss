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
        Schema::create('mail_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('mailtype');
            $table->string('mailin');
            $table->string('mailout');
            $table->string('status');
            $table->string('datereceive');
            $table->UnsignedBigInteger('bid');
            $table->foreign('bid')->references('id')->on('branches')->constrained()->onDelete('cascade');
            $table->UnsignedBigInteger('mid');
            $table->foreign('mid')->references('id')->on('inboxings')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_stocks');
    }
};

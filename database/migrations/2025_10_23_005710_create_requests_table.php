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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->nullable();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->string('doc_type');
            $table->string('notes');
            $table->string('action');
            $table->timestamps();
            $table->string('origin_user')->nullable();
            $table->string('origin_division')->nullable();
            $table->string('new_division')->nullable();
            $table->string('new_user')->nullable();
            $table->string('urgent')->nullable();

            $table->foreign('origin_user')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('origin_division')->references('division')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('new_division')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('new_user')->references('division')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};

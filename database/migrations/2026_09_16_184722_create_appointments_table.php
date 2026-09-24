<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');

            $table->string('customer_name');
            $table->string('email');

            $table->unsignedBigInteger('parlor_id')->nullable();
            $table->unsignedBigInteger('service_id');

            $table->dateTime('appointment_datetime');

            $table->text('note')->nullable();

            $table->string('status')->default('pending');

            $table->timestamps();

            $table->foreign('parlor_id')
                ->references('parlor_id')
                ->on('parlors')
                ->onDelete('set null');

            $table->foreign('service_id')
                ->references('service_id')
                ->on('services')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
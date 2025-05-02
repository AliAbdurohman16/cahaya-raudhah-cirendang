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
        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('kk')->nullable();
            $table->string('ktp')->nullable();
            $table->string('passport_photo')->nullable();
            $table->string('vaccine_certificate')->nullable();
            $table->string('health_certificate')->nullable();
            $table->string('passport')->nullable();

            $table->string('original_kk_size')->nullable();
            $table->string('compressed_kk_size')->nullable();

            $table->string('original_ktp_size')->nullable();
            $table->string('compressed_ktp_size')->nullable();

            $table->string('original_passport_photo_size')->nullable();
            $table->string('compressed_passport_photo_size')->nullable();

            $table->string('original_vaccine_certificate_size')->nullable();
            $table->string('compressed_vaccine_certificate_size')->nullable();

            $table->string('original_health_certificate_size')->nullable();
            $table->string('compressed_health_certificate_size')->nullable();

            $table->string('original_passport_size')->nullable();
            $table->string('compressed_passport_size')->nullable();

            $table->string('kk_validation_status')->default('belum valid')->nullable();
            $table->string('ktp_validation_status')->default('belum valid')->nullable();
            $table->string('passport_photo_validation_status')->default('belum valid')->nullable();
            $table->string('vaccine_certificate_validation_status')->default('belum valid')->nullable();
            $table->string('health_certificate_validation_status')->default('belum valid')->nullable();
            $table->string('passport_validation_status')->default('belum valid')->nullable();

            $table->string('kk_compression_ratio')->nullable();
            $table->string('kk_space_saving')->nullable();

            $table->string('ktp_compression_ratio')->nullable();
            $table->string('ktp_space_saving')->nullable();

            $table->string('passport_photo_compression_ratio')->nullable();
            $table->string('passport_photo_space_saving')->nullable();

            $table->string('vaccine_certificate_compression_ratio')->nullable();
            $table->string('vaccine_certificate_space_saving')->nullable();

            $table->string('health_certificate_compression_ratio')->nullable();
            $table->string('health_certificate_space_saving')->nullable();

            $table->string('passport_compression_ratio')->nullable();
            $table->string('passport_space_saving')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

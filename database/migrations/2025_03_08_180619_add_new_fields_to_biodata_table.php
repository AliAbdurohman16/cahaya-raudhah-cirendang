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
        Schema::table('biodata', function (Blueprint $table) {
            $table->string('original_kk_size')->after('kk')->nullable();
            $table->string('compressed_kk_size')->after('original_kk_size')->nullable();

            $table->string('original_ktp_size')->after('ktp')->nullable();
            $table->string('compressed_ktp_size')->after('original_ktp_size')->nullable();

            $table->string('passport_photo')->after('compressed_ktp_size')->nullable();
            $table->string('original_passport_photo_size')->after('passport_photo')->nullable();
            $table->string('compressed_passport_photo_size')->after('original_passport_photo_size')->nullable();

            $table->string('original_vaccine_certificate_size')->after('vaccine_certificate')->nullable();
            $table->string('compressed_vaccine_certificate_size')->after('original_vaccine_certificate_size')->nullable();

            $table->string('health_certificate')->after('compressed_vaccine_certificate_size')->nullable();
            $table->string('original_health_certificate_size')->after('health_certificate')->nullable();
            $table->string('compressed_health_certificate_size')->after('original_health_certificate_size')->nullable();

            $table->string('original_passport_size')->after('passport')->nullable();
            $table->string('compressed_passport_size')->after('original_passport_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodata', function (Blueprint $table) {
            $table->dropColumn('original_kk_size');
            $table->dropColumn('compressed_kk_size');
            $table->dropColumn('original_ktp_size');
            $table->dropColumn('compressed_ktp_size');
            $table->dropColumn('passport_photo');
            $table->dropColumn('original_passport_photo_size');
            $table->dropColumn('compressed_passport_photo_size');
            $table->dropColumn('original_vaccine_certificate_size');
            $table->dropColumn('compressed_vaccine_certificate_size');
            $table->dropColumn('health_certificate');
            $table->dropColumn('original_health_certificate_size');
            $table->dropColumn('compressed_health_certificate_size');
            $table->dropColumn('original_passport_size');
            $table->dropColumn('compressed_passport_size');
        });
    }
};

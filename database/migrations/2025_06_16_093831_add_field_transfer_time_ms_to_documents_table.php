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
        Schema::table('documents', function (Blueprint $table) {
            $table->float('kk_transfer_time_ms', 8, 2)->nullable()->after('kk_space_saving');
            $table->float('ktp_transfer_time_ms', 8, 2)->nullable()->after('ktp_space_saving');
            $table->float('passport_photo_transfer_time_ms', 8, 2)->nullable()->after('passport_photo_space_saving');
            $table->float('vaccine_certificate_transfer_time_ms', 8, 2)->nullable()->after('vaccine_certificate_space_saving');
            $table->float('health_certificate_transfer_time_ms', 8, 2)->nullable()->after('health_certificate_space_saving');
            $table->float('passport_transfer_time_ms', 8, 2)->nullable()->after('passport_space_saving');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('kk_transfer_time_ms');
            $table->dropColumn('ktp_transfer_time_ms');
            $table->dropColumn('passport_photo_transfer_time_ms');
            $table->dropColumn('vaccine_certificate_transfer_time_ms');
            $table->dropColumn('health_certificate_transfer_time_ms');
            $table->dropColumn('passport_transfer_time_ms');
        });
    }
};

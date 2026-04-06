<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('operations', function (Blueprint $table) {
            $table->date('uiux_due')->nullable()->after('uiux_status');
            $table->date('dev_due')->nullable()->after('dev_be');
        });
    }

    public function down(): void
    {
        Schema::table('operations', function (Blueprint $table) {
            $table->dropColumn(['uiux_due', 'dev_due']);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('operations', function (Blueprint $table) {
            $table->string('uiux_assign')->default('—')->after('prop_remark');
            $table->enum('uiux_status', ['Done', 'On Hold', 'Revisions'])->default('On Hold')->after('uiux_assign');
        });
    }

    public function down(): void
    {
        Schema::table('operations', function (Blueprint $table) {
            $table->dropColumn(['uiux_assign', 'uiux_status']);
        });
    }
};

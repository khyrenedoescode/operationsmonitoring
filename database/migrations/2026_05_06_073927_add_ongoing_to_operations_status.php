<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE operations MODIFY COLUMN status ENUM('Done', 'On Hold', 'Revisions', 'On-Going') DEFAULT 'On Hold'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE operations MODIFY COLUMN status ENUM('Done', 'On Hold', 'Revisions') DEFAULT 'On Hold'");
    }
};
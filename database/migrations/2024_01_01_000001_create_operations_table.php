<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('client');

            // tag is generated AFTER insert (needs the auto-increment ID),
            // so it must be nullable to allow the two-step create → update.
            // It is still unique once set.
            $table->string('tag')->nullable()->unique();

            $table->enum('stage', ['Homepage', 'Sitemap', 'All Pages', 'Final Homepage'])->default('Homepage');
            $table->string('prop_assign')->default('—');
            $table->text('prop_remark')->nullable();
            $table->string('dev_assign')->default('—');

            // Use string instead of enum for dev_fe/dev_be to accept empty string ''
            $table->string('dev_fe')->default('');
            $table->string('dev_be')->default('');

            $table->unsignedTinyInteger('fe')->default(0);
            $table->unsignedTinyInteger('be')->default(0);
            $table->enum('status', ['Done', 'On Hold', 'Revisions'])->default('On Hold');
            $table->date('due')->nullable();
            $table->text('final_remark')->nullable();
            $table->string('last_edited_by')->nullable();
            $table->string('last_edited_field')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
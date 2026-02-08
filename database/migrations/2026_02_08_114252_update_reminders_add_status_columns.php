<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reminders', function (Blueprint $table) {

            // new system
            $table->enum('status', ['pending', 'sent', 'failed'])
                  ->default('pending')
                  ->after('remind_at');

            $table->timestamp('sent_at')->nullable()->after('status');

            // remove old column
            $table->dropColumn('is_send');
        });
    }

    public function down(): void
    {
        Schema::table('reminders', function (Blueprint $table) {

            $table->boolean('is_send')->default(0);

            $table->dropColumn(['status', 'sent_at']);
        });
    }
};


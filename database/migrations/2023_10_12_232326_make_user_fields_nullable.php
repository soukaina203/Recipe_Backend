<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->timestamp('email_verified_at')->nullable()->change();
            $table->string('photo')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('city')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        // You can define the "down" method if needed.
    }
};

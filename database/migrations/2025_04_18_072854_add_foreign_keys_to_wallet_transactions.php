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
        Schema::table('wallet_transactions', function (Blueprint $table) {
            Schema::table('wallet_transactions', function (Blueprint $table) {
                $table->foreign('transfer_id')->references('id')->on('wallet_transfers')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            Schema::table('wallet_transactions', function (Blueprint $table) {
                $table->dropForeign('transfer_id');
            });
        });
    }
};

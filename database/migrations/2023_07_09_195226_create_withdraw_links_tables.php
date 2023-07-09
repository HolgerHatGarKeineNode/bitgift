<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lnbits_withdraw_links', function (Blueprint $table) {
            $table->id();
            $table->string('lnbits_id');
            $table->string('wallet');
            $table->string('title');
            $table->dateTime('valid_until');
            $table->unsignedBigInteger('min_withdrawable');
            $table->unsignedBigInteger('max_withdrawable');
            $table->unsignedInteger('uses');
            $table->unsignedInteger('wait_time');
            $table->boolean('is_unique');
            $table->string('unique_hash');
            $table->unsignedBigInteger('open_time');
            $table->string('lnurl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grifts');
    }
};

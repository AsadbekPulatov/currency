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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('code');
            $table->string('ccy');
            $table->string('ccyNm_RU');
            $table->string('ccyNm_UZ');
            $table->string('ccyNm_UZC');
            $table->string('ccyNm_EN');
            $table->tinyInteger('nominal');
            $table->decimal('rate');
            $table->decimal('diff');
            $table->date('date');
            $table->date('created_date');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};

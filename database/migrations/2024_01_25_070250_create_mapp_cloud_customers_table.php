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
        Schema::create('mapp_cloud_customers', function (Blueprint $table) {
            $table->id('cloud_id');
            $table->string('company_name');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('phone_number');
            $table->string('industry');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('city');
            $table->string('state_province');
            $table->string('postal_code');
            $table->string('country');
            $table->unsignedBigInteger('reseller_id');
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('financial_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapp_cloud_customers');
    }
};

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
        Schema::create('message_categories', function (Blueprint $table) {
            $table->id('message_category_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('category_name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();

            $table->foreign('customer_id')->references('cloud_id')->on('mapp_cloud_customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('message_categories', function (Blueprint $table) {
            $table->dropIfExists('message_categories');
        });
    }
};

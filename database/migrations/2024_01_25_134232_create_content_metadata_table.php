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
        Schema::create('content_metadata', function (Blueprint $table) {
            $table->id('content_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('element_type');
            $table->string('content_url');
            $table->string('content_name');
            $table->boolean('is_text');
            $table->boolean('is_image');
            $table->string('file_name');
            $table->boolean('is_public_visible');
            $table->boolean('is_editable');
            $table->text('description');
            $table->bigInteger('file_size');
            $table->integer('content_width')->nullable();
            $table->integer('content_height')->nullable();
            $table->string('mime_type', 50);
            $table->boolean('expiration_automatic');
            $table->integer('expiration_days');
            $table->timestamp('expiration_at');
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
        Schema::dropIfExists('content_metadata');
    }
};

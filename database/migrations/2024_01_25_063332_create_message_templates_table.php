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
        Schema::create('message_templates', function (Blueprint $table) {
            $table->id('template_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('message_category_id');
            $table->string('template_name');
            $table->text('template_content_json');
            $table->text('template_content_mjml');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();


            $table->foreign('message_category_id')->references('message_category_id')->on('message_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('message_templates', function (Blueprint $table) {
            $table->dropForeign(['message_category_id']);
            $table->dropIfExists('message_templates');
        });
    }
};

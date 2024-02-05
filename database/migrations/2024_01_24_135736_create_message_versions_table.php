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
        Schema::create('message_versions', function (Blueprint $table) {
            $table->id('version_id');
            $table->unsignedBigInteger('message_id');
            $table->string('version_name');
            $table->string('message_content');
            $table->string('version_comments');
            $table->tinyInteger('is_default');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();


            $table->foreign('message_id')->references('message_id')->on('messages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('message_versions', function (Blueprint $table) {
            $table->dropIfExists('message_versions');
        });
    }
};

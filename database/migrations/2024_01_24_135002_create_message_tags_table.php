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
        Schema::create('message_tags', function (Blueprint $table) {
            $table->id('message_tag_id');
            $table->unsignedBigInteger('message_id');
            $table->string('tag_name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();


            $table->foreign('message_id')->references('message_id')->on('messages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('message_tags', function (Blueprint $table) {
            $table->dropIfExists('message_tags');
        });
    }
};

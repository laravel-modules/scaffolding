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
        Schema::create('mail_templates', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->timestamps();
        });

        Schema::create('mail_template_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mail_template_id');
            $table->string('name')->nullable();
            $table->string('subject')->nullable();
            $table->text('content')->nullable();
            $table->string('locale')->index();
            $table->unique(['mail_template_id', 'locale']);
            $table->foreign('mail_template_id')->references('id')->on('mail_templates')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_template_translations');
        Schema::dropIfExists('mail_templates');
    }
};

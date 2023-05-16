<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leave_application_id');
            $table->string('doc_name')->nullable();
            $table->string('file_name');
            $table->foreign('leave_application_id')->references('id')->on('leave_applications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_documents');
    }
};

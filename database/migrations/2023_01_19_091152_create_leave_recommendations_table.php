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
        Schema::create('leave_recommendations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('leave_application_id');
            $table->boolean('recommendation')->default(false);
            $table->boolean('not_recommendation')->default(false);
            $table->text('comments')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('leave_recommendations');
    }
};

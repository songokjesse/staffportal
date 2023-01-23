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
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('leave_categories_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->bigInteger('days');
            $table->boolean('status');
            $table->text('comments')->nullable();
            $table->unsignedBigInteger('duties_by_user_id');
            $table->string('phone');
            $table->string('email');
            $table->foreign('duties_by_user_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('leave_categories_id')->references('id')->on('leave_categories');
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
        Schema::dropIfExists('leave_applications');
    }
};
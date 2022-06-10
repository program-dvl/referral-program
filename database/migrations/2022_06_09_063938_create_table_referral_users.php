<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableReferralUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('referred_by')->unsigned();
            $table->string('referral_email', 200);
            $table->enum('status',['1','0'])->default('0')->comment('0: Invitation sent, 1: Invitation Accepted');
            $table->timestamps();

            $table->foreign('referred_by')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referral_users');
    }
}

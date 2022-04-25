<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_bids', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('job_id');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->text('presentation_letter');
            $table->text('presentation_file')->nullable();
            $table->double('tax_per_hour',10,2);
            $table->double('app_tax',10,2);
            $table->double('tax_to_receive',10,2);
            $table->string('days');
            $table->enum('view',['1','0'])->default('0');
            $table->enum('interview',['1','0'])->default('0');
            $table->enum('accepted',['1','0'])->default('0');
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
        Schema::dropIfExists('customer_bids');
    }
}

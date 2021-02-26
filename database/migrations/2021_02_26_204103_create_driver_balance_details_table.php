<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverBalanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_balance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("driver_id")->constrained("driver_details")->onDelete("cascade");
            $table->double("balance");
            $table->integer("trip_no");
            $table->softDeletes();
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
        Schema::dropIfExists('driver_balance_details');
    }
}

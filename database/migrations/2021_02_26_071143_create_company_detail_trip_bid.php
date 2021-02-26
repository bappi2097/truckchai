<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailTripBid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_detail_trip_bid', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_detail_id')->constrained("company_details")->onDelete("cascade");
            $table->foreignId('trip_bid_id')->constrained("trip_bids")->onDelete("cascade");
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
        Schema::dropIfExists('company_detail_trip_bid');
    }
}

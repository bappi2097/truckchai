<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailsTrucks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details_trucks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_detail_id')->constrained("company_details")->onDelete('cascade');
            $table->foreignId('truck_id')->constrained("trucks")->onDelete('cascade');
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
        Schema::dropIfExists('company_details_trucks');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckCategoryTruckTripCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_category_truck_trip_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId("truck_category_id")->constrained("truck_categories")->onDelete("cascade");
            $table->foreignId("truck_trip_category_id");
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
        Schema::dropIfExists('truck_category_truck_trip_category');
    }
}

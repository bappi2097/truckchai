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
            $table->unsignedBigInteger("truck_trip_category_id");
            $table->foreign('truck_trip_category_id', "truck_category_truck_trip_category_trip_id")->references("id")->on("truck_trip_categories")->onDelete("cascade");
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

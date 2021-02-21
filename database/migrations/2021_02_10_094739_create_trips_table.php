<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id")->constrained("customer_details")->onDelete("cascade");
            $table->foreignId("truck_category_id")->constrained("truck_categories")->onDelete("cascade");
            $table->foreignId("product_id")->constrained("products")->onDelete("cascade");
            $table->text("load_location");
            $table->text("unload_location");
            $table->timestamp("load_time");
            $table->tinyInteger("status")->default(0);
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
        Schema::dropIfExists('trips');
    }
}

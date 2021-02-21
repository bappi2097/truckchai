<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId("truck_model_category_id")->constrained("truck_model_categories")->onDelete("cascade");
            $table->foreignId("truck_covered_category_id")->constrained("truck_covered_categories")->onDelete("cascade");
            $table->foreignId("truck_size_category_id")->constrained("truck_size_categories")->onDelete("cascade");
            $table->foreignId("truck_weight_category_id")->constrained("truck_weight_categories")->onDelete("cascade");
            $table->text("description")->nullable();
            $table->text("image")->nullable();
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
        Schema::dropIfExists('truck_categories');
    }
}

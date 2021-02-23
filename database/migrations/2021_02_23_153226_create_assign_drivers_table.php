<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained("driver_details")->onDelete("cascade");
            $table->foreignId('truck_id')->constrained("trucks")->onDelete("cascade");
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
        Schema::dropIfExists('assign_drivers');
    }
}

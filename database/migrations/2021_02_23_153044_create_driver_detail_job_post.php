<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverDetailJobPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_detail_job_post', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained("driver_details")->onDelete("cascade");
            $table->foreignId('job_post_id')->constrained("job_posts")->onDelete("cascade");
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('driver_detail_job_post');
    }
}

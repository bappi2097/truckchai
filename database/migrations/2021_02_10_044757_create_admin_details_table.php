<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users", "id")->onDelete("cascade");
            $table->uuid("uuid")->from(10000);
            $table->text("address");
            $table->string("whatsapp_no")->nullable();
            $table->string("image", 255);
            $table->boolean("is_super_admin")->default(0);
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
        Schema::dropIfExists('admin_details');
    }
}

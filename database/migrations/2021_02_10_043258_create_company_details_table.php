<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users", "id")->onDelete("cascade");
            $table->foreignId("company_type_id")->constrained("company_types", "id")->onDelete("cascade");
            $table->uuid("uuid")->from(10000);
            $table->text("address");
            $table->string("account_name");
            $table->string("image", 255);
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
        Schema::dropIfExists('company_details');
    }
}

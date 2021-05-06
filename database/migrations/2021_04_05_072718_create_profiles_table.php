<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id')->comment("Profiles id");
            $table->integer('user_id')->comment("Users Id to which profile is linked");
            $table->string('name')->nullalble()->comment("Users name");
            $table->string('phone')->nullable()->comment("users phone number");
            $table->string('address')->nullable()->comment("Users home address");
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
        Schema::dropIfExists('profiles');
    }
}

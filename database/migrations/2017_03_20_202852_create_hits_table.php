<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('school_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('address')->nullable();
            $table->string('other_details')->nullable();
            $table->string('image')->nullable();
            $table->enum('location', ['GMA', 'NORTH LUZON', 'SOUTH LUZON', 'VISAYAS', 'MINDANAO']);
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('project_location_id')
//                ->references('id')
//                ->on('project_locations')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hits');
    }
}

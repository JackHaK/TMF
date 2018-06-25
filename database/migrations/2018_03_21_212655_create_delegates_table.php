<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegates', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('eventID');
            $table->string('courseID');
            $table->integer('contactID');
            $table->string('name');
            $table->string('email')->nullable();
            $table->binary('administrateDelegateJSON');
            $table->timestamps();
            $table->unique(['eventID','contactID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delegates');
    }
}

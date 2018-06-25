<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
          $table->integer('id');
	        $table->string('title');
          $table->binary('length');
          $table->float('price',8,2)->nullable();
          $table->boolean('active');
          $table->string('page');
	        $table->binary('administrateCourseJSON');
          $table->binary('courseJSON')->nullable();
          $table->binary('categoriesJSON')->nullable();
          $table->boolean('useLocal')->default(false);
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
        Schema::dropIfExists('courses');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTestimonials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('testimonials', function (Blueprint $table) {
            //
           
          $table->Integer('status');
            $table->dropColumn('image');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('testimonials', function (Blueprint $table) {
            Schema::dropColumn('image');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dynamiccontents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
 Schema::create('dynamiccontents', function (Blueprint $table) {
            $table->id();
            $table->text('firstpagebannertitle1');
            $table->text('firstpagebannertitle2');
            $table->text('firstcolumntitle1');
            $table->text('firstcolumntitle2');
            $table->text('firstcolumntitle3');
            $table->text('secondcolumntitle');
            $table->text('secondcolumncontent');
            $table->text('thirdcolumntitle');
            $table->text('thirdcolumncontent');
            $table->text('footertitle');
            $table->text('footercontent');
            $table->text('secondpagebannertitle1');
            $table->text('secondpagebannertitle2');
            $table->text('secondpagebannertitle3');
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
        //
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExteriorMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

 Schema::create('exteriormaster', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('value');
            $table->Integer('status');
            $table->Integer('sortorder');
            $table->string('image');
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

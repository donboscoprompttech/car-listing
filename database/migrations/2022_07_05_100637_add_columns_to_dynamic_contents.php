<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDynamicContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dynamiccontents', function (Blueprint $table) {
            //
            $table->text('bottompagelefttitle');
            $table->text('bottompageleftcontent');
            $table->text('bottompagerighttitle');
            $table->text('bottompagerightContent');
            $table->text('faqContent');
            $table->text('enquiryContent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dynamiccontents', function (Blueprint $table) {
            //
        });
    }
}

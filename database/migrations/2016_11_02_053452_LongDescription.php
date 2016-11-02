<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LongDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('feeds', function ($table) {
            $table->dropColumn(['description']);
        });

        Schema::table('feeds', function ($table) {
            $table->longText('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feeds', function ($table) {
            $table->dropColumn(['description']);
        });

        Schema::table('feeds', function ($table) {
            $table->string('description');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->string('address')->after('admin')->nullable();
            $table->string('city')->after('address')->nullable();
            $table->string('state')->after('city')->nullable();
            $table->unsignedInteger('country_id')->after('state')->nullable();
            $table->string('pincode')->after('country_id')->nullable();
            $table->string('mobile')->after('pincode')->nullable();

            $table->foreign('country_id')->references('id')->on('countries');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
              $table->dropColumn('address');
              $table->dropColumn('city');
              $table->dropColumn('state');
              $table->dropForeign(['country_id']);
              $table->dropColumn('pincode');
              $table->dropColumn('mobile');
        });
    }
}

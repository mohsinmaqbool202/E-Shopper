<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccessToAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->enum('type', ['Admin','Sub-Admin'])->after('password');
            $table->tinyInteger('categories_access')->after('type')->default(0);
            $table->tinyInteger('products_access')->after('categories_access')->default(0);
            $table->tinyInteger('orders_access')->after('products_access')->default(0);
            $table->tinyInteger('users_access')->after('orders_access')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('categories_access');
            $table->dropColumn('products_access');
            $table->dropColumn('orders_access');
            $table->dropColumn('users_access');
        });
    }
}

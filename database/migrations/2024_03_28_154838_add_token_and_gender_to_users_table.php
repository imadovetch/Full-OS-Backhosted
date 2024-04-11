<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenAndGenderToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('token')->nullable()->after('password'); // Add the token column after the password column
            $table->string('gender')->nullable()->after('token'); // Add the gender column after the token column
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['token', 'gender']); // Drop the token and gender columns if rolling back the migration
        });
    }
}

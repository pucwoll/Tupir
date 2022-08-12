<?php namespace AppTupir\User\Updates;

use October\Rain\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class UpdateUsersAddUUID extends Migration
{
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('uuid')->nullable()->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

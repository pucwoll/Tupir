<?php namespace AppTupir\User\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class UpdateUsersAddIsPublished extends Migration
{
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->boolean('is_published')->default(true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

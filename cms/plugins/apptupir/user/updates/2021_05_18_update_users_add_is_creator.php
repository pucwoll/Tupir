<?php namespace AppGamisfera\User\Updates;

use Illuminate\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class UpdateUsersAddIsCreator extends Migration
{
    public function up()
    {
        Schema::table('users', function ($table){
            $table->boolean('is_creator')->default(false);
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

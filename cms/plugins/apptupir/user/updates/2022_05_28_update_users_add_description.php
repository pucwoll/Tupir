<?php namespace AppTupir\User\Updates;

use Illuminate\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class UpdateUsersAddDescription extends Migration
{
    public function up()
    {
        Schema::table('users', function ($table){
            $table->string('description')->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

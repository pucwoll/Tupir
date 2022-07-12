<?php namespace LibUser\UserFlag\Updates;

use October\Rain\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class CreateUserFlagsTable extends Migration
{
    public function up()
    {
        Schema::create('libuser_userflag_user_flags', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->nullableMorphs('flaggable');
            $table->unsignedBigInteger('user_id')->index()->nullable();
            
            $table->string('type')->nullable();
            $table->integer('value')->nullable();
            
            $table->string('text')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('libuser_userflag_user_flags');
    }
}

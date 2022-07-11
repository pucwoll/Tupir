<?php namespace LibUser\Role\Updates;

use Illuminate\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class UpdateUsersAddUserRole extends Migration
{
    /*
     * October up
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('user_role')->default('user')->nullable()->after('password');
        });
    }
    
    /*
     * October down
     */
    public function down()
    {
    }
}

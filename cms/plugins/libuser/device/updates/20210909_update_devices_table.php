<?php namespace LibUser\Device\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class UpdateDevicesTable_20210909 extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('libuser_device_devices')) {
            return;
        }

        Schema::table('libuser_device_devices', function (Blueprint $table) {
            $table->dateTime('expire_at')->nullable();
        });
    }

    public function down()
    {
        if (!Schema::hasTable('libuser_device_devices')) {
            return;
        }

        Schema::table('libuser_device_devices', function (Blueprint $table) {
            $table->dropColumn('expire_at');
        });
    }
}

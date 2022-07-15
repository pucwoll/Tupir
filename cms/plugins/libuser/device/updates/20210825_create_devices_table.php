<?php namespace LibUser\Device\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreateDevicesTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('libuser_device_devices')) {
            return;
        }

        Schema::create('libuser_device_devices', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->string('name')->nullable();
            $table->string('token')->index();
            $table->string('platform');
            $table->string('manufacturer');
            $table->string('model');
            $table->string('os');
            $table->string('os_version');
            $table->string('app_version');
            $table->string('app_build');
            $table->string('uuid')->index();
            $table->longText('raw_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('libuser_device_devices');
    }
}

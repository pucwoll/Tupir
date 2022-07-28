<?php namespace LibUser\Report\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateUserReportsTable20210720 extends Migration
{
    public function up()
    {
        Schema::create('libuser_report_user_reports', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->morphs('reportable', 'reportable_type_reportable_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('libuser_report_user_reports');
    }
}

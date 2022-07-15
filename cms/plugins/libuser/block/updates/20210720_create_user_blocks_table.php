<?php namespace LibUser\Block\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class CreateUserBlocksTable20210720 extends Migration
{
    public function up()
    {
        Schema::create('libuser_block_user_blocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->unsignedBigInteger('blocked_user_id')->index('blocked_user_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('libuser_block_user_blocks');
    }
}

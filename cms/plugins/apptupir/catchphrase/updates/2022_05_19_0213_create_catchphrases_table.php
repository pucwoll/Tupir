<?php namespace AppTupir\Catchphrase\Updates;

use October\Rain\Support\Facades\Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCatchphrasesTable extends Migration
{
    public function up()
    {
        Schema::create('apptupir_catchphrases', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('uuid')->nullable()->unique();

            $table->string('title')->nullable()->index();
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->string('audio')->nullable();
            $table->text('lyrics')->nullable();

            $table->text('tags_string')->nullable();

            $table->integer('user_id')->index();

            $table->boolean('is_published')->default(false)->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apptupir_catchphrases');
    }
}

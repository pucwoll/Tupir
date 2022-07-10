<?php namespace AppTupir\Catchphrase\Updates;

use Illuminate\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class CreateCatchphrasesTable extends Migration
{
    public function up()
    {
        Schema::create('apptupir_catchphrases', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('title')->nullable()->index();
            $table->string('slug')->nullable()->unique();
            $table->string('audio')->nullable();
            $table->text('lyrics')->nullable();

            $table->integer('user_id')->index();

            $table->unsignedInteger('sort_order')->nullable()->index();
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

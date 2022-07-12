<?php namespace LibChat\Comments\Updates;

use Illuminate\Support\Facades\Schema;
use October\Rain\Database\Updates\Migration;

class CreateCommentsTable extends Migration
{
    /*
     * October Up
     */
    public function up()
    {
        Schema::create('libchat_comments_comments', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedBigInteger('commentable_id')->nullable()->index('commentable_id');
            $table->string('commentable_type')->nullable()->index('commentable_type');
            $table->unsignedBigInteger('creatable_id')->nullable()->index('creatable_id');

            $table->string('creatable_type')->nullable()->index('creatable_type');
            $table->text('content')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable()->index('parent_id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /*
     * October Down
     */
    public function down()
    {
        Schema::dropIfExists('libchat_comments_comments');
    }
}

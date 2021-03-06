<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable(false);
            $table->unsignedInteger('project_id')->references('id')->on('projects')->unsigned()->index()->nullable();
            $table->unsignedTinyInteger('status_id')->unsigned()->default(1)->comment("状態");
            $table->unsignedTinyInteger('priority_id')->unsigned()->nullable()->comment("優先度");
//            $table->integer('note_id')->unsigned()->nullable();
            $table->timestamp('due_at')->nullable()->comment("期限");
            $table->timestamp('start_at')->nullable()->comment("実行開始時間");
            $table->unsignedInteger('time')->unsigned()->default(0)->comment("計測時間");
            $table->unsignedInteger('user_id')->references('id')->on('users')->unsigned()->index()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}

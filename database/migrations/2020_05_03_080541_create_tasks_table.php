<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tasks'))
        {
            Schema::create('tasks', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('resp_id');
                $table->unsignedInteger('owner_id');
                $table->string('title');
                $table->string('description')->nullable();
                $table->date('deadline');
                $table->integer('priority_code');
                $table->timestamps();
            });
        }
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

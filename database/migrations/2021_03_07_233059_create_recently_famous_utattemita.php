<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecentlyFamousUtattemita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recently_famous_utattemita', function (Blueprint $table) {
            $table->string('video_id');
            $table->string('title');
            $table->unsignedBigInteger('view_count');
            $table->date('published_at');
            $table->primary('video_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recently_famous_utattemita');
    }
}

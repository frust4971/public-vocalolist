<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInsertAtToRecentlyFamousVocalovideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recently_famous_vocalovideos', function (Blueprint $table) {
            $table->timestamp('insert_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recently_famous_vocalovideos', function (Blueprint $table) {
            $table->dropColumn('insert_at');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('link_id');
            $table->foreign ( 'link_id' )->references ( 'id' )->on ( 'links' );
            $table->text('headers');
            $table->string('user_agent');
            $table->string('ip');
            $table->string('region')->nullable();
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
        Schema::table('information', function(Blueprint $table){
            $table->dropForeign('information_link_id_foreign');
            $table->dropColumn('link_id');
        });

        Schema::dropIfExists('information');
    }
}

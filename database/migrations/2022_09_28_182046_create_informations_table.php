<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(tableName('informations'), function (Blueprint $table) {
            $table->id();
            $table->string('identifier');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('url');
            $table->string('socials');
            $table->text('description');
            $table->integer('informationable_id');
            $table->string('informationable_type');
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
        Schema::dropIfExists(tableName('informations'));
    }
}

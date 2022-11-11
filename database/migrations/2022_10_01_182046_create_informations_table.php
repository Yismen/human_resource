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
            $table->string('phone', 50);
            $table->string('email', 200)->nullable();
            $table->string('photo_url', 2000)->nullable();
            $table->text('address')->nullable();
            $table->string('company_id', 200)->nullable();
            $table->integer('informationable_id')->unsigned();
            $table->string('informationable_type', 200);
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

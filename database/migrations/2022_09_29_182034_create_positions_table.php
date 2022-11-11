<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Dainsys\HumanResource\Models\Department;
use Dainsys\HumanResource\Models\PaymentType;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(tableName('positions'), function (Blueprint $table) {
            $table->id();
            $table->string('name', 500);
            $table->foreignIdFor(Department::class)->constrained();
            $table->foreignIdFor(PaymentType::class)->constrained();
            $table->integer('salary')->unsigned();
            $table->text('description')->nullable();
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
        Schema::dropIfExists(tableName('positions'));
    }
}

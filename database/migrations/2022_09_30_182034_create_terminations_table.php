<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Dainsys\HumanResource\Models\TerminationType;
use Dainsys\HumanResource\Models\TerminationReason;

class CreateTerminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(tableName('terminations'), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->constrained();
            $table->date('date');
            $table->foreignIdFor(TerminationType::class)->constrained();
            $table->foreignIdFor(TerminationReason::class)->constrained();
            $table->boolean('rehireable')->default(true);
            $table->text('comments')->nullable();
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
        Schema::dropIfExists(tableName('terminations'));
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Database\Migrations\Migration;
use Dainsys\HumanResource\Models\SuspensionType;

class CreateHrSuspensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(tableName('suspensions'), function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->constrained(tableName('employees'));
            $table->foreignIdFor(SuspensionType::class)->constrained(tableName('suspension_types'));
            $table->date('starts_at');
            $table->date('ends_at');
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
        Schema::dropIfExists(tableName('suspensions'));
    }
}

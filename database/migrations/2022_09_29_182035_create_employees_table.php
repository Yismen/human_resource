<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Dainsys\HumanResource\Support\Enums\Gender;
use Dainsys\HumanResource\Support\Enums\MaritalStatus;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(tableName('employees'), function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('second_first_name')->nullable();
            $table->string('last_name');
            $table->string('second_last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('personal_id', 11)->unique();
            $table->dateTime('hired_at');
            $table->date('date_of_birth');
            $table->string('cellphone', 15)->unique();
            $table->enum('status', (new EmployeeStatus())->all());
            $table->enum('marriage', (new MaritalStatus())->all());
            $table->enum('gender', (new Gender())->all());
            $table->boolean('kids')->default(false);
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
        Schema::dropIfExists(tableName('employees'));
    }
}

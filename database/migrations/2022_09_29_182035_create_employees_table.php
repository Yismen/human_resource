<?php

use Dainsys\HumanResource\Models\Afp;
use Dainsys\HumanResource\Models\Ars;
use Dainsys\HumanResource\Models\Site;
use Illuminate\Support\Facades\Schema;
use Dainsys\HumanResource\Models\Project;
use Illuminate\Database\Schema\Blueprint;
use Dainsys\HumanResource\Models\Position;
use Dainsys\HumanResource\Models\Supervisor;
use Dainsys\HumanResource\Models\Citizenship;
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
            $table->enum('status', EmployeeStatus::all());
            $table->enum('marriage', MaritalStatus::all());
            $table->enum('gender', Gender::all());
            $table->boolean('kids')->default(false);
            $table->foreignIdFor(Site::class)->nullable()->constrained();
            $table->foreignIdFor(Project::class)->nullable()->constrained();
            $table->foreignIdFor(Position::class)->nullable()->constrained();
            $table->foreignIdFor(Supervisor::class)->nullable()->constrained();
            $table->foreignIdFor(Citizenship::class)->nullable()->constrained();
            $table->foreignIdFor(Afp::class)->nullable()->constrained();
            $table->foreignIdFor(Ars::class)->nullable();
            // $table->foreignIdFor(Ars::class)->nullable()->constrained();
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

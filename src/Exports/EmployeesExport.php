<?php

namespace Dainsys\HumanResource\Exports;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use Dainsys\HumanResource\Models\Employee;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping
{
    public $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function collection()
    {
        return Employee::whereIn('id', $this->employees)->get();
    }

    public function headings(): array
    {
        return [
            ['Employees List'],
            [],
            ['Id', 'Full Name', 'Personal Id', 'Hire Date', 'Status', 'Marital', 'Gender', 'Has Kids'],
        ];
    }

    public function map($employee): array
    {
        return [
            $employee->id,
            $employee->full_name,
            $employee->personal_id,
            Date::dateTimeToExcel($employee->hired_at),
            $employee->status,
            $employee->marriage,
            $employee->gender,
            $employee->kids ? 'Yes' : 'No',
            // optional($employee->site)->name,
            // optional($employee->project)->name,
            // optional($employee->position)->name,
            // optional($employee->department)->name,
            // optional($employee->supervisor)->name,
            // optional($employee->citizenship)->name,
            // optional($employee->ars)->name,
            // optional($employee->afp)->name,
            // optional($employee->bank_account)->name,
            // optional($employee->bank)->name,
        ];
    }
}

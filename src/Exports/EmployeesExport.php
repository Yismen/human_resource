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
        return Employee::query()
            ->whereIn('id', $this->employees)
            ->with([
                'site',
                'project',
            ])
            ->get();
    }

    public function headings(): array
    {
        return [
            ['Employees List'],
            [],
            ['Id', 'Full Name', 'Personal Id', 'Hire Date', 'Status', 'Marital', 'Gender', 'Site', 'Project', 'Position', 'Department', 'Citizenship', 'Supervisor', 'Afp', 'Ars', 'B. Account', 'Bank', 'Has Kids'],
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
            optional($employee->site)->name,
            optional($employee->project)->name,
            optional($employee->position)->name,
            optional($employee->department)->name,
            optional($employee->citizenship)->name,
            optional($employee->supervisor)->name,
            optional($employee->afp)->name,
            optional($employee->ars)->name,
            optional($employee->bank_account)->name,
            optional($employee->bank)->name,
            $employee->kids ? 'Yes' : 'No',
        ];
    }
}

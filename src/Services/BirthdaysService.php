<?php

namespace Dainsys\HumanResource\Services;

use InvalidArgumentException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use Dainsys\HumanResource\Models\Employee;

class BirthdaysService
{
    protected string $type;
    protected array $types = [
        'today',
        'yesterday',
        'tomorrow',
        'this_month',
        'next_month',
        'last_month',
    ];

    public function handle(string $type = 'today'): Collection
    {
        $this->type = $type;

        if (!in_array($type, $this->types)) {
            throw new InvalidArgumentException('Invalid argument passed. options are ' . join(', ', $this->types));
        }

        $birthdays = $this->query()
                ->with(['site', 'project', 'position.department', 'supervisor'])
                ->when(
                    config('database.default') === 'sqlite',
                    fn ($q) => $q->orderByRaw('strftime("%m%d"), date_of_birth'),
                    fn ($q) => $q
                        ->orderByRaw('MONTH(date_of_birth)', 'ASC')
                        ->orderByRaw('DAY(date_of_birth)', 'ASC')
                )
                ->get();

        return $birthdays->map(function ($employee) {
            return [
                'id' => $employee->id,
                'name' => $employee->full_name,
                'date_of_birth' => $employee->date_of_birth->format('Y-m-d'),
                'age' => $employee->date_of_birth->age . ' years old',
                'site' => $employee->site->name,
                'project' => $employee->project->name,
                'position' => $employee->position->name,
                'department' => $employee->position->department->name,
                'supervisor' => optional($employee->supervisor)->name,
            ];
        });
        return Cache::rememberForever("birdays_{$type}", function () {
        });
    }

    protected function query(): Builder
    {
        $date = now();

        return Employee::query()
        ->when(
            $this->type === 'today',
            fn ($q) => $q->whereMonth('date_of_birth', $date->month)->whereDay('date_of_birth', $date->day)
        )
        ->when(
            $this->type === 'yesterday',
            fn ($q) => $q->whereMonth('date_of_birth', $date->copy()->subDay()->month)->whereDay('date_of_birth', $date->copy()->subDay()->day)
        )
        ->when(
            $this->type === 'tomorrow',
            fn ($q) => $q->whereMonth('date_of_birth', $date->copy()->addDay()->month)->whereDay('date_of_birth', $date->copy()->addDay()->day)
        )
        ->when(
            $this->type === 'this_month',
            fn ($q) => $q->whereMonth(
                'date_of_birth',
                $date->month
            )->where(
                fn ($q) => $q->whereDay('date_of_birth', '>=', $date->copy()->startOfMonth()->day)
                ->orWhereDay('date_of_birth', '<=', $date->copy()->endOfMonth()->day)
            )
        )
        ->when(
            $this->type === 'last_month',
            fn ($q) => $q->whereMonth(
                'date_of_birth',
                $date->copy()->subMonth()->month
            )->where(
                fn ($q) => $q->whereDay('date_of_birth', '>=', $date->copy()->subMonth()->startOfMonth()->day)
                ->orWhereDay('date_of_birth', '<=', $date->copy()->subMonth()->endOfMonth()->day)
            )
        )
        ->when(
            $this->type === 'next_month',
            fn ($q) => $q->whereMonth(
                'date_of_birth',
                $date->copy()->addMonth()->month
            )->where(
                fn ($q) => $q->whereDay('date_of_birth', '>=', $date->copy()->addMonth()->startOfMonth()->day)
                ->orWhereDay('date_of_birth', '<=', $date->copy()->addMonth()->endOfMonth()->day)
            )
        )
        ->notInactive();
    }
}

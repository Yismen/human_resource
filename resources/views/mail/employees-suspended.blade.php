@component('mail::message')
# Employees Suspended

Please see below a list of all employees currently in suspension status:

@component('mail::table')
| Name | Site | Project | Starts At | Ends At |
| ------------- | ------------- | ------------- | ------------- | ------------- |
@foreach ($employees as $employee)
@foreach ($employee->suspensions as $suspension)
| {{ $employee->full_name }} | {{ $employee->site->name }} | {{ $employee->project->name }} | {{
$suspension->starts_at->format('M/d/y')
}} | {{ $suspension->ends_at->format('M/d/y') }}
@endforeach
@endforeach
@endcomponent
{{-- @component('mail::button', ['url' => ''])
{{ __('Profile') }}
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
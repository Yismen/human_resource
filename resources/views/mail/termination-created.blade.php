@component('mail::message')
# Employee Terminated

Employee <b>{{ $termination->employee->full_name }}</b> was terminated with termination by {{
$termination->terminationType->name }}, with termination date {{ $termination->date->format('Y-m-d') }}. The termination
reason is {{ $termination->terminationReason->name }}.

{{-- @component('mail::button', ['url' => ''])
{{ __('Profile') }}
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
@component('mail::message')
# Employee Suspended

Employee <b>{{ $suspension->employee->full_name }}</b> was reported a {{ $suspension->suspensionType->name }} suspension
from
{{ $suspension->starts_at->format('Y-m-d') }} to {{ $suspension->ends_at->format('Y-m-d') }}. During this period the
employee should not be working for the company. Please plan accordingly.

{{-- @component('mail::button', ['url' => ''])
{{ __('Profile') }}
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
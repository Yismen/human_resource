@component('mail::message')
# Employee Created

Employee <b>{{ $employee->full_name }}</b> was created with hire date {{ $employee->hired_at->format('Y-m-d') }}. This
person
was assigned to site {{ $employee->site->name }} and was hired for project {{ $employee->project->name }}.

{{-- @component('mail::button', ['url' => ''])
{{ str(__('human_resource::messages.profile'))->headline() }}
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
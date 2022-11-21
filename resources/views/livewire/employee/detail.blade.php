<div>
    <livewire:human_resource::information.form />

    <x-human_resource::modal title="{{ __('Employee') }} - {{ $employee->full_name ?? '' }}" modal-name="EmployeeDetails"
        event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ __('Name') }}:</th>
                    <td class="text-left">{{ $employee->full_name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Personal Id') }}:</th>
                    <td class="text-left">{{ $employee->personal_id ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Hired At') }}:</th>
                    <td class="text-left">{{ optional(optional($employee)->hired_at)->format('M-d-Y') }} - {{ optional(optional($employee)->hired_at)->diffForHumans() ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Cellphone') }}:</th>
                    <td class="text-left">{{ $employee->cellphone ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Age') }}:</th>
                    <td class="text-left">{{ optional(optional($employee)->date_of_birth)->format('M-d-Y') }} - {{ optional(optional($employee)->date_of_birth)->age ?? '' }} {{ __('Yeemployee') }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Gender') }}:</th>
                    <td class="text-left">{{ $employee->gender ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Marital') }}:</th>
                    <td class="text-left">{{ $employee->marriage ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Has Kids') }}?:</th>
                    <td class="text-left">{{ $employee->kids ?? '' }}</td>
                </tr>
            </tbody>
        </table>
        

        <x-human_resource::information.detail :information="$employee->information ?? ''"
            :model-name="optional($employee)->getMorphClass()" :model-id="$employee->id ?? ''" />

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updateEmployee", {{ $employee->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>
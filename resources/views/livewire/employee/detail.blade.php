<div>
    <x-human_resource::modal title="{{ __('Employee') }} - {{ $employee->name ?? '' }}" modal-name="EmployeeDetails"
        event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ __('Name') }}:</th>
                    <td class="text-left">{{ $employee->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Description') }}:</th>
                    <td class="text-left">{{ $employee->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updateEmployee", {{ $employee->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>
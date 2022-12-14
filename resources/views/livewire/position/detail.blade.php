<div>
    <x-human_resource::modal title="{{ __('Position') }} - {{ $position->name ?? '' }}" modal-name="PositionDetails"
        event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ __('Name') }}:</th>
                    <td class="text-left">{{ $position->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Department') }}:</th>
                    <td class="text-left">{{ $position->department->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Payment Type') }}:</th>
                    <td class="text-left">{{ $position->paymentType->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Salary') }}:</th>
                    <td class="text-left">${{ $position->salary ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Description') }}:</th>
                    <td class="text-left">{{ $position->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updatePosition", {{ $position->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>
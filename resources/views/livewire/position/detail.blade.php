<div>
    <x-human_resource::modal title="{{ str(__('human_resource::messages.position'))->headline() }} - {{ $position->name ?? '' }}" modal-name="PositionDetails"
        event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.name'))->headline() }}:</th>
                    <td class="text-left">{{ $position->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.department'))->headline() }}:</th>
                    <td class="text-left">{{ $position->department->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Payment Type') }}:</th>
                    <td class="text-left">{{ $position->paymentType->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.salary'))->headline() }}:</th>
                    <td class="text-left">${{ $position->salary ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.description'))->headline() }}:</th>
                    <td class="text-left">{{ $position->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updatePosition", {{ $position->id ?? '' }})'>{{
                str(__('human_resource::messages.edit'))->headline() }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>
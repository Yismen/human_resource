<div>
    <x-human_resource::modal title="{{ str(__('human_resource::messages.suspension'))->headline() }} - {{ $suspension->name ?? '' }}"
        modal-name="SuspensionDetails" event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.name'))->headline() }}:</th>
                    <td class="text-left">{{ $suspension->employee->full_name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.type'))->headline() }}:</th>
                    <td class="text-left">{{ $suspension->suspensionType->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Starts At') }}:</th>
                    <td class="text-left">{{ optional($suspension->starts_at ?? null)->format('Y-m-d') ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Ends At') }}:</th>
                    <td class="text-left">{{ optional($suspension->ends_at ?? null)->format('Y-m-d') ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.duration'))->headline() }}:</th>
                    <td class="text-left">{{ $suspension ? $suspension->duration : null }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ str(__('human_resource::messages.comments'))->headline() }}:</th>
                    <td class="text-left">{{ $suspension->comments ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm"
                wire:click='$emit("updateSuspension", {{ $suspension->id ?? '' }})'>{{
                str(__('human_resource::messages.edit'))->headline() }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>
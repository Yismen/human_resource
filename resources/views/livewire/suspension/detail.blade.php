<div>
    <x-human_resource::modal title="{{ __('Suspension') }} - {{ $suspension->name ?? '' }}"
        modal-name="SuspensionDetails" event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ __('Name') }}:</th>
                    <td class="text-left">{{ $suspension->employee->full_name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Type') }}:</th>
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
                    <th class="text-right">{{ __('Duration') }}:</th>
                    <td class="text-left">{{ $suspension ? $suspension->duration : null }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Comments') }}:</th>
                    <td class="text-left">{{ $suspension->comments ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm"
                wire:click='$emit("updateSuspension", {{ $suspension->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>
<div>
    <livewire:human_resource::information.form />

    <x-human_resource::modal title="{{ __('Ars') }} - {{ $ars->name ?? '' }}" modal-name="ArsDetails"
        event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ __('Name') }}:</th>
                    <td class="text-left">{{ $ars->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Description') }}:</th>
                    <td class="text-left">{{ $ars->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-human_resource::information.detail :information="$ars->information ?? ''"
            :model-name="optional($ars)->getMorphClass()" :model-id="$ars->id ?? ''" />

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updateArs", {{ $ars->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>
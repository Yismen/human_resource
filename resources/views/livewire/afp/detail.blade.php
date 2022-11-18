<div>
    <livewire:human_resource::information.form />

    <x-human_resource::modal title="{{ __('Afp') }} - {{ $afp->name ?? '' }}" modal-name="AfpDetails"
        event-name="{{ $this->modal_event_name_detail }}">

        <table class="table table-striped table-inverse table-sm">
            <tbody class="thead-inverse">
                <tr>
                    <th class="text-right">{{ __('Name') }}:</th>
                    <td class="text-left">{{ $afp->name ?? '' }}</td>
                </tr>
                <tr>
                    <th class="text-right">{{ __('Description') }}:</th>
                    <td class="text-left">{{ $afp->description ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <x-human_resource::information.detail :information="$afp->information ?? ''"
            :model-name="optional($afp)->getMorphClass()" :model-id="$afp->id ?? ''" />

        <x-slot name="footer">
            <button class="btn btn-warning btn-sm" wire:click='$emit("updateAfp", {{ $afp->id ?? '' }})'>{{
                __('Edit') }}</button>
        </x-slot>
    </x-human_resource::modal>
</div>
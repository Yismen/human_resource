@props(['information', 'modelName', 'modelId'])
<div class="border-top bg-gradient-info py-2">
    <h5 class="px-2">{{ str(__('human_resource::messages.information'))->headline() }}</h5>

    @if (isset($information) && $information )
    <table class="table table-striped table-inverse table-sm">
        <tbody class="thead-inverse">
            <tr>
                <th class="text-right">{{ str(__('human_resource::messages.photo'))->headline() }}:</th>
                <td class="text-left">
                    <a href="{{ '/storage/' . $information->photo_url ?? '' }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ '/storage/' . $information->photo_url ?? '' }}" height="120" width="120" class="img-thumbnail rounded-circle" alt="{{ $information->photo_url ?? '' }}">
                    </a>
                </td>
            </tr>
            <tr>
                <th class="text-right">{{ str(__('human_resource::messages.phone'))->headline() }}:</th>
                <td class="text-left">{{ $information->phone ?? '' }}</td>
            </tr>
            <tr>
                <th class="text-right">{{ str(__('human_resource::messages.email'))->headline() }}:</th>
                <td class="text-left">{{ $information->email ?? '' }}</td>
            </tr>
            <tr>
                <th class="text-right">{{ str(__('human_resource::messages.address'))->headline() }}:</th>
                <td class="text-left">{{ $information->address ?? '' }}</td>
            </tr>
            <tr>
                <th class="text-right">{{ __('Company Id') }}:</th>
                <td class="text-left">{{ $information->company_id ?? '' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="btn btn-sm btn-dark mx-2" wire:click='$emit("updateInformation", "{{ $information->id }}")'>{{
        str(__('human_resource::messages.edit'))->headline()
        }}
        {{
        str(__('human_resource::messages.information'))->headline() }}</div>
    @else
    <div class="alert alert-danger m-2" role="alert">
        <strong>In information added!</strong>
    </div>

    <div class="btn btn-sm btn-primary mx-2"
        wire:click='$emit("createInformation", "{{ str($modelName ?? '')->afterLast("\\") }}", "{{ $modelId }}" )'>
        {{ str(__('human_resource::messages.add'))->headline() }} {{ str(__('human_resource::messages.information'))->headline() }}
    </div>
    @endif
</div>
<div>
    @if ($editing)
        <div style="background-color: #ffeae8;">
            <div class="d-flex justify-content-end">
                <button class="mt-2 mr-2" wire:click='$set("editing", {{ false }})'> X </button>
            </div>
            <x-human_resource::form :editing="false">
                <div class="p-3">
    
                    <div class="row">
                        <div class="col-sm-4">
                            <x-human_resource::inputs.with-labels field="termination.date" type="date">{{
                                str(__('human_resource::messages.date'))->headline() }}:
                            </x-human_resource::inputs.with-labels>
                        </div>
                        <div class="col-sm-4">
                            <x-human_resource::inputs.select field="termination.termination_type_id" :options="$termination_types">{{
                                str(__('human_resource::messages.type'))->headline() }}:
                            </x-human_resource::inputs.select>
                        </div>
                        <div class="col-sm-4">
                            <x-human_resource::inputs.select field="termination.termination_reason_id" :options="$termination_reasons">{{
                                str(__('human_resource::messages.reason'))->headline() }}:
                            </x-human_resource::inputs.select>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-sm-4">
                            <x-human_resource::inputs.switch field="termination.rehireable" class="{{ $termination->rehireable ? 'text-success' : 'text-danger' }}">{{
                                str(__('human_resource::messages.rehireable'))->headline() }}:
                            </x-human_resource::inputs.switch>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-sm-12">
                            <x-human_resource::inputs.text-area field="termination.comments">{{
                                str(__('human_resource::messages.comments'))->headline() }}:
                            </x-human_resource::inputs.text-area>
                        </div>
                    </div>
                </div>
            </x-human_resource::form>
        </div>
    @else
        <button class="btn btn-danger btn-sm" wire:click='prepare()'>
            {{ str(__('human_resource::messages.inactivate'))->headline() }}
        </button>
    @endif
</div>
<div>
    @if ($editing)
        <div style="background-color: #fff4c9;">
            <div class="d-flex justify-content-end">
                <button class="mt-2 mr-2" wire:click='$set("editing", {{ false }})'> X </button>
            </div>
            <x-human_resource::form :editing="false">
                <div class="p-3">
    
                    <div class="row">
                        <div class="col-sm-4">
                            <x-human_resource::inputs.select field="suspension.suspension_type_id" :options="$suspension_types">{{
                                __('Type') }}:
                            </x-human_resource::inputs.select>
                        </div>
                        <div class="col-sm-4">
                            <x-human_resource::inputs.with-labels field="suspension.starts_at" type="date">{{
                                __('Start Date') }}:
                            </x-human_resource::inputs.with-labels>
                        </div>
                        <div class="col-sm-4">
                            <x-human_resource::inputs.with-labels field="suspension.ends_at" type="date">{{
                                __('End Date') }}:
                            </x-human_resource::inputs.with-labels>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-sm-12">
                            <x-human_resource::inputs.text-area field="suspension.comments">{{
                                __('Comments') }}:
                            </x-human_resource::inputs.text-area>
                        </div>
                    </div>
                </div>
            </x-human_resource::form>
        </div>
    @else
        <button class="btn btn-warning btn-sm" wire:click='prepare()'>
            {{ __('Add Suspension') }}
        </button>
    @endif
</div>
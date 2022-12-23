<div>
    @if ($editing)
        <div style="background-color: #cbffea;">
            <div class="d-flex justify-content-end">
                <button class="mt-2 mr-2" wire:click='$set("editing", {{ false }})'> X </button>
            </div>
            <x-human_resource::form :editing="false">
                <div class="p-3">
    
                    <div class="row">
                        <div class="col-sm-8">
                            <x-human_resource::inputs.with-labels field="reactivation.hired_at" type="date">{{
                                str(__('human_resource::messages.date'))->headline() }}:
                            </x-human_resource::inputs.with-labels>
                        </div>
                </div>
            </x-human_resource::form>
        </div>
    @else
        <button class="btn btn-success btn-sm" wire:click='prepare()'>
            {{ str(__('human_resource::messages.reactivate'))->headline() }}
        </button>
    @endif
</div>
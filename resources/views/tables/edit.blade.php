<a href="#" class="btn btn-warning btn-sm" wire:click.prevent='$emit("update{{ $this->module }}", "{{ $row->id }}")'>{{
    str(__('human_resource::messages.edit'))->headline() }}</a>
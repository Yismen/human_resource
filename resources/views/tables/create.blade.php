<a href="#" class="btn btn-primary btn-sm bg-gradient" wire:click.prevent='$emit("create{{ $module }}")'>{{
    str(__('human_resource::messages.create'))->headline() }}</a>
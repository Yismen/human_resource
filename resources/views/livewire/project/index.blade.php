<div>
    <livewire:human_resource::project.detail />
    <livewire:human_resource::project.form />
    <div class="card ">
        <div class="card-body text-black" :key="time()">
            <livewire:human_resource::project.table />
        </div>
    </div>
</div>
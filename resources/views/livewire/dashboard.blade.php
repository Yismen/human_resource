<div>
    <h3>Human Resource Dashboard </h3>

    <div class="row" style="padding: 1rem 1rem;
    border: 1px solid #bdbdbd;
    border-radius: 4px;
    position: fixed;
    bottom: 5rem;
    right: 1rem;
    z-index: 10;

    background-color: rgb(239, 239, 239);">
        <h5 style="position: absolute;
        top: -20px;
        background-color: white;
        padding: 0.25rem 2rem;
        border-radius: 5px;
        box-shadow: -4px 8px 4px #cdcdcd;">Filters</h5>

        <x-human_resource::inputs.select type="primary" field="site" :options="$sites_list">Site:
        </x-human_resource::inputs.select>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <livewire:human_resource::charts.pie title="Employees by Site" :data="$by_site" />
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <livewire:human_resource::charts.pie title="Employees by Project" :data="$by_project" />
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <livewire:human_resource::charts.pie title="Employees by Department" :data="$by_department" />
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <livewire:human_resource::charts.pie title="Employees by Position" :data="$by_position" />
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <livewire:human_resource::charts.pie title="Employees by Supervisor" :data="$by_supervisor" />
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <livewire:human_resource::charts.pie title="Employees by Gender" :data="$by_gender" />
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <livewire:human_resource::charts.pie title="Employees by Marriage" :data="$by_marriage" />
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <livewire:human_resource::charts.pie title="Employees by Parenting" :data="$by_kids" />
                </div>
            </div>
        </div>
    </div>
    {{-- @dump($sites) --}}

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @endpush

</div>
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
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <livewire:human_resource::charts.column title="Monthly Headcount" :keys="$attrition->keys()->all()"
                        :values="$attrition->map(function($item) {return $item['head_count'];})->values()->all()"
                        height="20rem;" :with-random-colors="true" key="headcount_{{ $site }}" />
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <livewire:human_resource::charts.line title="Monthly Attrition Rate"
                        :keys="$attrition->keys()->all()"
                        :values="$attrition->map(function($item) {return floor($item['attrition'] * 100);})->values()->all()"
                        :with-random-colors="true" height="20rem;" key="attrition_{{ $site }}" />
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <livewire:human_resource::charts.pie title="Employees by Site"
                                :keys="$by_site->pluck('name')->all()"
                                :values="$by_site->pluck('employees_count')->all()" key="by_site_count_{{ $site }}" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <livewire:human_resource::charts.pie title="Employees by Project"
                                :keys="$by_project->pluck('name')->all()"
                                :values="$by_project->pluck('employees_count')->all()"
                                key="by_project_count_{{ $site }}" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <livewire:human_resource::charts.pie title="Employees by Department"
                                :keys="$by_department->pluck('name')->all()"
                                :values="$by_department->pluck('employees_count')->all()"
                                key="by_department_count_{{ $site }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <livewire:human_resource::charts.pie title="Employees by Position"
                                :keys="$by_position->pluck('name')->all()"
                                :values="$by_position->pluck('employees_count')->all()"
                                key="by_position_count_{{ $site }}" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <livewire:human_resource::charts.pie title="Employees by Supervisor"
                                :keys="$by_supervisor->pluck('name')->all()"
                                :values="$by_supervisor->pluck('employees_count')->all()"
                                key="by_supervisor_count_{{ $site }}" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <livewire:human_resource::charts.pie title="Employees by Gender"
                                :keys="$by_gender->pluck('name')->all()"
                                :values="$by_gender->pluck('employees_count')->all()"
                                key="by_gender_count_{{ $site }}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <livewire:human_resource::charts.pie title="Employees by Marriage"
                                :keys="$by_marriage->pluck('name')->all()"
                                :values="$by_marriage->pluck('employees_count')->all()"
                                key="by_marriage_count_{{ $site }}" />
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <livewire:human_resource::charts.pie title="Employees by Parenting"
                                :keys="$by_kids->pluck('name')->all()"
                                :values="$by_kids->pluck('employees_count')->all()"
                                key="by_parenting_count_{{ $site }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <h4>Todays Birthdays</h4>
            @unless ($birthdays->count() > 0)
            <div class="alert alert-warning" role="alert">
                <strong>No birthdays!</strong> None of your peers have birthdays today!
            </div>
            @else
            @foreach ($birthdays as $birthday)
            <div class="card d-flex flex-row bg-gradient-success">
                <a href="/storage/{{ $birthday['photo'] }}" target="__new" rel="noopener noreferrer" style="flex: 0.4;">
                    <img src="/storage/{{ $birthday['photo'] }}" class="" alt="Image" width="100%">
                </a>
                <div class="card-body" style="flex: 1;">
                    <h4 class="card-title text-bold">{{ $birthday['name'] }}</h4>
                    <p class="card-text text-sm">
                        Turning {{ $birthday['age'] }}. Works in site <b>{{ $birthday['site'] }}</b>, project {{
                        $birthday['project'] }} and for supervisor <b>{{ $birthday['supervisor'] }}</b>
                    </p>
                </div>
            </div>
            @endforeach
            @endunless

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="text-red">Issues</h4>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                            Missing Information
                            <span class="badge bg-gradient-danger badge-pill">{{ $issues['missing_information_count']
                                }}</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                            Missing Supervisor
                            <span class="badge bg-gradient-danger badge-pill">{{ $issues['missing_supervisor_count']
                                }}</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                            Missing AFP
                            <span class="badge bg-gradient-danger badge-pill">{{ $issues['missing_afp_count'] }}</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between">
                            Missing ARS
                            <span class="badge bg-gradient-danger badge-pill">{{ $issues['missing_ars_count'] }}</span>
                        </a>
                    </div>

                    {{-- <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            List item
                            <span class="badge bg-gradient-danger badge-pill">{{ $issues['missing_information_count']
                                }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center disabled">
                            Disabled item
                            <span class="badge bg-gradient-danger badge-pill">{{ $issues['missing_supervisor_count']
                                }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center disabled">
                            Disabled item
                            <span class="badge bg-gradient-danger badge-pill">{{ $issues['missing_afp_count'] }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center disabled">
                            Disabled item
                            <span class="badge bg-gradient-danger badge-pill">{{ $issues['missing_ars_count'] }}</span>
                        </li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @endpush

</div>
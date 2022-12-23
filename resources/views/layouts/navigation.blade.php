<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('human_resource.admin.dashboard.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ str(__('human_resource::messages.dashboard'))->headline() }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('human_resource.about') }}" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ str(__('human_resource::messages.about'))->headline() }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        {{ __('Human Resource Links') }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @can('viewAny', \Dainsys\HumanResource\Models\Citizenship::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.citizenships.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.citizenships'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Department::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.departments.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.departments'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\PaymentType::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.payment_types.index') }}" target="_top"
                            class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Payment Types') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Position::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.positions.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.positions'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Project::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.projects.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.projects'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Site::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.sites.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.sites'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Employee::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.employees.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.employees'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\TerminationType::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.termination_reasons.index') }}" target="_top"
                            class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Termination Reasons') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\TerminationReason::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.termination_types.index') }}" target="_top"
                            class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Termination Types') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Termination::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.terminations.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.termination'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\SuspensionType::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.suspension_types.index') }}" target="_top"
                            class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('Suspension Type') }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Suspension::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.suspensions.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.suspension'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Supervisor::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.supervisors.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.supervisors'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Afp::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.afps.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.afps'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Ars::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.arss.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.arss'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\HumanResource\Models\Bank::class)
                    <li class="nav-item">
                        <a href="{{ route('human_resource.admin.banks.index') }}" target="_top" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.banks'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle nav-icon"></i>
                    <p>
                        {{ __('Mailings Links') }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    @can('viewAny', \Dainsys\Mailing\Models\Mailable::class)
                    <li class="nav-item">
                        <a href="{{ route('mailing.admin.mailables.index') }}" target="__new" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.mailables'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan

                    @can('viewAny', \Dainsys\Mailing\Models\Recipient::class)
                    <li class="nav-item">
                        <a href="{{ route('mailing.admin.recipients.index') }}" target="__new" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ str(__('human_resource::messages.recipients'))->headline() }}</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
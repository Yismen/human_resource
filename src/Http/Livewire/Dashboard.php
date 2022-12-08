<?php

namespace Dainsys\HumanResource\Http\Livewire;

use Livewire\Component;
use Dainsys\HumanResource\Services\HC\ByKids;
use Dainsys\HumanResource\Services\HC\BySite;
use Dainsys\HumanResource\Services\HC\ByGender;
use Dainsys\HumanResource\Services\SiteService;
use Dainsys\HumanResource\Services\HC\ByProject;
use Dainsys\HumanResource\Services\HC\ByMarriage;
use Dainsys\HumanResource\Services\HC\ByPosition;
use Dainsys\HumanResource\Services\HC\ByDepartment;
use Dainsys\HumanResource\Services\HC\BySupervisor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Dashboard extends Component
{
    use AuthorizesRequests;

    public $site;
    protected $colos;
    protected $listeners = ['setProject'];
    protected $queryString = 'site';

    public function setProject($event)
    {
        $this->site = $event['title'];
    }

    public function render(
        BySite $bySite,
        ByProject $byProject,
        ByDepartment $byDepartment,
        BySupervisor $bySupervisor,
        ByGender $byGender,
        ByMarriage $byMarriage,
        ByKids $byKids,
        ByPosition $byPosition
    ) {
        // dd($byKids->count());
        return view('human_resource::livewire.dashboard', [
            'by_site' => $bySite->count(),
            'by_project' => $byProject->count(),
            'by_department' => $byDepartment->count(),
            'by_position' => $byPosition->count(),
            'by_supervisor' => $bySupervisor->count(),
            'by_gender' => $byGender->count(),
            'by_marriage' => $byMarriage->count(),
            'by_kids' => $byKids->count(),
            'sites_list' => SiteService::list(),
        ])
        ->layout('human_resource::layouts.app');
    }
}

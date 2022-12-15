<?php

namespace Dainsys\HumanResource\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Services\HC\ByKids;
use Dainsys\HumanResource\Services\HC\BySite;
use Dainsys\HumanResource\Services\HC\ByGender;
use Dainsys\HumanResource\Services\SiteService;
use Dainsys\HumanResource\Services\HC\ByProject;
use Dainsys\HumanResource\Services\HC\ByMarriage;
use Dainsys\HumanResource\Services\HC\ByPosition;
use Dainsys\HumanResource\Services\IssuesService;
use Dainsys\HumanResource\Services\HC\ByDepartment;
use Dainsys\HumanResource\Services\HC\BySupervisor;
use Dainsys\HumanResource\Services\BirthdaysService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Dainsys\HumanResource\Services\Attrition\AttritionService;

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
        ByPosition $byPosition,
        BirthdaysService $birthdays,
        IssuesService $issues
    ) {
        return view('human_resource::livewire.dashboard', [
            'by_site' => $bySite->filters(['id' => $this->site])->count(),
            'by_project' => $byProject->filters(['employees.site.id' => $this->site])->count(),
            'by_department' => $byDepartment->filters(['employees.site.id' => $this->site])->count(),
            'by_position' => $byPosition->filters(['employees.site.id' => $this->site])->count(),
            'by_supervisor' => $bySupervisor->filters(['employees.site.id' => $this->site])->count(),
            'by_gender' => $byGender->filters(['site.id' => $this->site])->count(),
            'by_marriage' => $byMarriage->filters(['site.id' => $this->site])->count(),
            'by_kids' => $byKids->filters(['site.id' => $this->site])->count(),
            'birthdays' => $birthdays->filters(['site.id' => $this->site])->handle('today'),
            'attrition' => $this->getAttrition(),
            'sites_list' => SiteService::list(),
            'issues' => $issues->filters(['site.id' => $this->site])->handle(),
            'current_count' => Employee::notInactive()->when($this->site, fn ($q) => $q->where('site_id', $this->site))->count(),
            'suspended' => Employee::suspended()->when($this->site, fn ($q) => $q->where('site_id', $this->site))->count(),
            'attrition_mtd' => (new AttritionService(now()->startOfMonth(), now(), ['site.id' => $this->site]))->getData()['attrition']

        ])
        ->layout('human_resource::layouts.app');
    }

    protected function getAttrition(): Collection
    {
        $attrition = [];

        foreach (range(11, 0) as $month) {
            $date_from = now()->subMonths($month)->startOfMonth();
            $date_to = now()->subMonths($month)->endOfMonth();
            $attrition[$date_to->format('Y-M')] = (new AttritionService($date_from, $date_to, ['site.id' => $this->site]))->getData();
        }

        return collect($attrition);
    }
}

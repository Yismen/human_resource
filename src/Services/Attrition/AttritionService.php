<?php

namespace Dainsys\HumanResource\Services\Attrition;

use Carbon\Carbon;

class AttritionService
{
    protected AttritionContract $actives_at_period_start;

    protected AttritionContract $actives_at_period_end;

    protected AttritionContract $gains;

    protected AttritionContract $terminations;

    protected array $data = [];
    protected Carbon $date_from;

    protected Carbon $date_to;

    public function __construct(Carbon $date_from = null, Carbon $date_to = null)
    {
        $this->date_from = $date_from ?: now();
        $this->date_to = $date_to ?: now();

        $this->actives_at_period_start = new ActivesStartService($date_from, $date_to);
        $this->actives_at_period_end = new ActivesEndService($this->date_from, $this->date_to);
        $this->gains = new HiredService($this->date_from, $this->date_to);
        $this->terminations = new TerminatedService($this->date_from, $this->date_to);
    }

    public function getData()
    {
        $this->data['actives_at_start'] = $this->actives_at_period_start->count();
        $this->data['gains'] = $this->gains->count();
        $this->data['terminations'] = $this->terminations->count();
        $this->data['head_count'] = $this->actives_at_period_end->count();
        $average_hc = ($this->data['head_count'] + $this->data['actives_at_start']) / 2;

        $this->data['attrition'] = $average_hc === 0 ? 0 : $this->data['terminations'] / $average_hc;

        return collect($this->data);
    }
}

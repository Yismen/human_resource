<?php

namespace Dainsys\HumanResource\Services\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    public function filters(array $filters): self
    {
        $this->filters = $filters;

        return $this;
    }

    protected function parseFilters(array $filters, Builder $query): Builder
    {
        foreach ($filters as $name => $value) {
            if (!$value || strlen(trim($value)) === 0) {
                return $query;
            }

            if (str($name)->contains('.')) {
                $split = preg_split("/[\.]+/", $name, -1, PREG_SPLIT_NO_EMPTY);
                if (count($split) === 2) {
                    $query = $query->whereHas($split[0], fn ($q) => $q->where($split[1], 'like', $value));
                } else {
                    // dd($split, $split[2], $value);
                    $query = $query->whereHas($split[0], fn ($q) => $q->whereHas($split[1], fn ($q) => $q->where($split[2], 'like', $value)));
                }
                return $query;
            }

            $query = $query->where($name, 'like', $value);
        }

        return $query;
    }
}

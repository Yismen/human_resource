<?php

namespace Dainsys\HumanResource\Services;

use Dainsys\HumanResource\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public $query;
    public $search;
    public array $searchableColumns = ['name', 'description', 'reference', 'tags'];

    public function __construct()
    {
        $this->query = Product::query();
    }

    public function search($search): self
    {
        $this->search = $search;

        return $this;
    }

    public function get(array $columns = ['*']): Collection
    {
        return $this->query
            ->when($this->search, function ($query) {
                $searchTerms = preg_split("/[\s]+/", $this->search, -1, PREG_SPLIT_NO_EMPTY);

                foreach ($searchTerms as $value) {
                    $query->where(function ($query) use ($value) {
                        foreach ($this->searchableColumns as $index => $column) {
                            $query->{$index === 0 ? 'where' : 'orWhere'}($column, 'like', '%' . $value . '%');
                        }
                    });
                }
            })->get($columns);
    }
}

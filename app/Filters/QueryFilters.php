<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QueryFilters
{
    /**
     * @var Request
     */
    protected Request $request;
    /**
     * @var Builder
     */
    protected Builder $builder;

    /**
     * QueryFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filled filters
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            $originalName = $name;
            $camelCaseName = Str::camel($name);

            if (!method_exists($this, $camelCaseName)) {
                continue;
            }

            if (!is_null($this->request->get($originalName)) and $this->request->get($originalName) !== '') {
                $this->$camelCaseName($value);
            }
        }

        return $this->builder;
    }

    /**
     * Get filters
     * @return array
     */
    public function filters(): array
    {
        return $this->request->all();
    }

    /**
     * @param $name
     * @param null $value
     * @return void
     */
    public function addFilter($name, $value = null): void
    {
        $this->request->merge([$name => $value]);
    }

    /**
     * Remove all filters from request
     * @return void
     */
    public function flushAllFilters(): void
    {
        $this->request = new Request();
    }
}

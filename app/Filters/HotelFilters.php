<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class HotelFilters extends QueryFilters
{
    /**
     * @param string $name
     * @return Builder
     */
    public function name(string $name): Builder
    {
        return $this->builder->where('name', 'like', "%$name%");
    }

    /**
     * @param int $bedrooms
     * @return Builder
     */
    public function bedrooms(int $bedrooms): Builder
    {
        return $this->builder->where('bedrooms', '=', $bedrooms);
    }

    /**
     * @param int $bathrooms
     * @return Builder
     */
    public function bathrooms(int $bathrooms): Builder
    {
        return $this->builder->where('bathrooms', '=', $bathrooms);
    }

    /**
     * @param int $storeys
     * @return Builder
     */
    public function storeys(int $storeys): Builder
    {
        return $this->builder->where('storeys', '=', $storeys);
    }

    /**
     * @param int $garages
     * @return Builder
     */
    public function garages(int $garages): Builder
    {
        return $this->builder->where('garages', '=', $garages);
    }

    /**
     * @param int $priceFrom
     * @return Builder
     */
    public function priceFrom(int $priceFrom): Builder
    {
        return $this->builder->where('price', '>=', $priceFrom);
    }

    /**
     * @param int $priceTo
     * @return Builder
     */
    public function priceTo(int $priceTo): Builder
    {
        return $this->builder->where('price', '<=', $priceTo);
    }
}

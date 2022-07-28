<?php

namespace App\Services;

use App\Filters\HotelFilters;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Collection;

class HotelService
{
    /**
     * @param HotelFilters $filters
     * @return Collection
     */
    public function search(HotelFilters $filters): Collection
    {
        return Hotel::query()->filter($filters)->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Filters\HotelFilters;
use App\Http\Requests\HotelSearchRequest;
use App\Services\HotelService;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class HotelController extends Controller
{
    use ApiResponder;

    /**
     * @var HotelService
     */
    private HotelService $hotelService;

    /**
     * @param HotelService $hotelService
     */
    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    /**
     * @param HotelSearchRequest $request
     * @param HotelFilters $filters
     * @return JsonResponse
     */
    public function search(HotelSearchRequest $request, HotelFilters $filters): JsonResponse
    {
        $hotels = $this->hotelService->search($filters);

        if ($hotels->count()) {
            return $this->dataResponse($hotels);
        }

        return $this->errorResponse('No such hotels by given criteria', ResponseAlias::HTTP_NOT_FOUND);
    }
}

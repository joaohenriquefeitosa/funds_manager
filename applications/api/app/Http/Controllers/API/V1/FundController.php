<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fund\IndexFormRequest;
use App\Services\Fund\FundServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class FundController extends Controller
{
    /**
     * @var FundServiceInterface
     */
    private $fundService;

    /**
     * FundController constructor.
     * 
     * @param FundServiceInterface $fundService
     */
    public function __construct(FundServiceInterface $fundService)
    {
        $funds = $this->fundService = $fundService;

        return response()->json([
            'success' => true,
            'data' => $funds,
        ]);
    }

    /**
     * List all funds.
     * 
     * @param IndexFormRequest $request
     * 
     * @return JsonResponse
     */
    public function index(IndexFormRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['length'] = 10;

        $response = $this->fundService->index($data);        

        return response()->json(
            $response,
            Response::HTTP_OK
        );
    }
}

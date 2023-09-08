<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fund\CreateFormRequest;
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $response = $this->fundService->show($id);

        return response()->json(
            $response,
            Response::HTTP_OK
        );
    }

    /**
     * Delete the specified resource.
     *
     * @param int $id
     * 
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->fundService->delete($id);

        return response()->json(
            null,
            Response::HTTP_NO_CONTENT
        );
    }

    public function store(CreateFormRequest $request): JsonResponse
    {
        $data = $request->validated();
        $response = $this->fundService->create($data);

        if(!$response){
            return response()->json(
                ['error' => 'Error creating fund'],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return response()->json(
            $response,
            Response::HTTP_CREATED
        );
    }
}

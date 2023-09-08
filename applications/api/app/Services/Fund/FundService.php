<?php

namespace App\Services\Fund;

use App\Models\Fund;
use App\Repositories\Fund\FundRepositoryInterface;
use App\Repositories\FundManager\FundManagerRepositoryInterface;

class FundService implements FundServiceInterface
{
    /**
     * @var FundRepositoryInterface
     */
    private $fundRepository;

    /**
     * @var FundManagerRepositoryInterface
     */
    private $fundManagerRepository;

    /**
     * FundService constructor.
     * 
     * @param FundRepositoryInterface $fundRepository
     */
    public function __construct(
        FundRepositoryInterface $fundRepository,
        FundManagerRepositoryInterface $fundManagerRepository
    )
    {
        $this->fundRepository           = $fundRepository;
        $this->fundManagerRepository    = $fundManagerRepository;
    }

    /**
     * List all funds.
     * 
     * @param array $data
     * 
     * @return array
     */
    public function index(array $data): array
    {
        return $this->fundRepository->index($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * 
     * @return array|null
     */
    public function show(int $id): ?array
    {
        return $this->fundRepository->show($id);
    }

    /**
     * Delete the specified resource.
     *
     * @param int $id
     * 
     * @return array
     */
    public function delete(int $id): void
    {
        if(!$this->show($id)){
            return;
        }
        
        $this->fundRepository->delete($id);
    }

    /**
     * Create the specified resource.
     *
     * @param array $data
     * 
     * @return Fund
     */
    public function create(array $data): ?Fund
    {
        try {            
            $fundManager = $this->fundManagerRepository->getFundManagerByName($data['manager']);
            if(!$fundManager) {
                $fundManager = $this->fundManagerRepository->create($data['manager']);
            }

            unset($data['manager']);
            $data['manager_id'] = $fundManager['id'];
            
            return $this->fundRepository->create($data);

        } catch (\Throwable $th) {
            return null;
        }
    }
}
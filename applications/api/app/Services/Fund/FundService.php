<?php

namespace App\Services\Fund;

use App\Repositories\Fund\FundRepositoryInterface;

class FundService implements FundServiceInterface
{
    /**
     * @var FundRepositoryInterface
     */
    private $fundRepository;

    /**
     * FundService constructor.
     * 
     * @param FundRepositoryInterface $fundRepository
     */
    public function __construct(FundRepositoryInterface $fundRepository)
    {
        $this->fundRepository = $fundRepository;
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
}
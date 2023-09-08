<?php

namespace App\Repositories\Fund;

use App\Models\Fund;
use App\Services\Fund\FundServiceInterface;

class FundRepository implements FundServiceInterface
{
    /**
     * @var Fund
     */
    private $fund;

    /**
     * FundRepository constructor.
     * 
     * @param Fund $fund
     */
    public function __construct(Fund $fund)
    {
        $this->fund = $fund;
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
        $funds = $this->fund::filter($data)
            ->paginate($length);

        return $funds;
    }   
}
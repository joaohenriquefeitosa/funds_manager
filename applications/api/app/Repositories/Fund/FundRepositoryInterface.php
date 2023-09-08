<?php

namespace App\Repositories\Fund;

interface FundRepositoryInterface
{
    /**
     * List all funds.
     * 
     * @param array $data
     * 
     * @return array
     */
    public function index(array $data): array;
}
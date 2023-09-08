<?php

namespace App\Services\Fund;

interface FundServiceInterface
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
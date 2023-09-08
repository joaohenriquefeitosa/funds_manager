<?php

namespace App\Repositories\FundManager;

use App\Models\FundManager;

interface FundManagerRepositoryInterface
{
    /**
     * Return a manager by name.
     * 
     * @param string $name
     * 
     * @return array|null
     */
    public function getFundManagerByName(string $name): ?array;

    /**
     * Create a new manager.
     * 
     * @param string $name
     * 
     * @return FundManager
     */
    public function create(string $name): FundManager;
}
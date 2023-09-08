<?php

namespace App\Repositories\FundManager;

use App\Models\FundManager;

class FundManagerRepository implements FundManagerRepositoryInterface
{
    /**
     * @var FundManager
     */
    private $fundManager;

    /**
     * FundManagerRepository constructor.
     * 
     * @param FundManager $fundManager
     */
    public function __construct(FundManager $fundManager)
    {
        $this->fundManager = $fundManager;
    }

    /**
     * Return a manager by name.
     * 
     * @param string $name
     * 
     * @return array|null
     */
    public function getFundManagerByName(string $name): ?array
    {
        try {
            return $this->fundManager::where('name', $name)->firstOrFail();            
        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * Create a new manager.
     * 
     * @param string $name
     * 
     * @return FundManager
     */
    public function create(string $name): FundManager
    {
        return $this->fundManager::create(['name' => $name]);
    }
}
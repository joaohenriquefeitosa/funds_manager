<?php

namespace App\Repositories\Fund;

use App\Models\Fund;
use App\Models\FundManager;

class FundRepository implements FundRepositoryInterface
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
        $funds = $this->fund::with(['manager', 'aliases'])
            ->filter($data)
            ->paginate($data['length']);
        
        $fundData = $funds->toArray();

        return $fundData;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * 
     * @return  array|null
     */
    public function show(int $id): ?array
    {
        $fund = $this->fund::with(['manager', 'aliases'])->find($id);

        if(!$fund) {
            return null;
        }

        $fundData = $fund->toArray();

        return $fundData;
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
        $fund = $this->fund::findOrFail($id);

        $fund->delete();
    }

    /**
     * Create a new resource.
     * 
     * @param array $data
     * 
     * @return Fund
     */
    public function create(array $data): Fund
    {
        try {
            $fund = $this->fund::create($data);
            $fund->save();

            return $fund;
        } catch (\Exception $e) {
            return false;
        }
    }
}
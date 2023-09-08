<?php

namespace App\Repositories\Fund;

use App\Events\DuplicateFundWarning;
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
        $funds = $this->fund::with(['manager', 'aliases', 'companies'])
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
     * @return  Fund|null
     */
    public function show(int $id): ?Fund
    {
        $fund = $this->fund::with(['manager', 'aliases', 'companies'])->find($id);

        if(!$fund) {
            return null;
        }

        return $fund;
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
            if ($this->isDuplicateFund($data)) {
                event(new DuplicateFundWarning($fund));
            }

            $fund = $this->fund::create($data);
            $fund->save();

            return $fund;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Update the specified resource.
     * 
     * @param array $data
     * @param int $id
     * 
     * @return ?Fund
     */
    public function update(array $data, int $id): ?Fund
    {
        try {
            $fund = $this->fund::findOrFail($id);
            $fund->update($data);

            return $fund;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Check if a duplicate fund condition is met.
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function isDuplicateFund(array $data): bool
    {
        $name = $data['name'] ?? null;
        $managerId = $data['manager_id'] ?? null;

        if (!$name || !$managerId) {
            return false;
        }

        $existingFund = $this->fund::where('name', $name)
            ->where('manager_id', $managerId)
            ->first();

        return $existingFund !== null;
    }
}
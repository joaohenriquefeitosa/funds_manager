<?php

namespace App\Repositories\Fund;

use App\Models\Fund;
use App\Models\FundManager;

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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * 
     * @return  Fund|null
     */
    public function show(int $id): ?Fund;

    /**
     * Delete the specified resource.
     *
     * @param int $id
     * 
     * @return array
     */
    public function delete(int $id): void;

    /**
     * Create a new resource.
     * 
     * @param array $data
     * 
     * @return Fund
     */
    public function create(array $data): Fund;

    /**
     * Update the specified resource.
     * 
     * @param array $data
     * @param int $id
     * 
     * @return ?Fund
     */
    public function update(array $data, int $id): ?Fund;

    /**
     * Check if a duplicate fund condition is met.
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function isDuplicateFund(array $data): bool;
}
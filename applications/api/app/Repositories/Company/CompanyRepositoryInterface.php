<?php

namespace App\Repositories\Company;

use App\Models\Company;

interface CompanyRepositoryInterface
{
    /**
     * Return a company by name.
     * 
     * @param string $name
     * 
     * @return array|null
     */
    public function getByName(string $name): ?array;

    /**
     * Create a new company.
     * 
     * @param string $name
     * 
     * @return Company
     */
    public function create(string $name): Company;
}
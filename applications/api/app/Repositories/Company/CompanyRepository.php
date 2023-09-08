<?php

namespace App\Repositories\Company;

use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @var Company
     */
    private $company;

    /**
     * CompanyRepository constructor.
     * 
     * @param Company $Company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Return a company by name.
     * 
     * @param string $name
     * 
     * @return array|null
     */
    public function getByName(string $name): ?array
    {
        try {
            return $this->company::where('name', $name)->firstOrFail();            
        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * Create a new company.
     * 
     * @param string $name
     * 
     * @return Company
     */
    public function create(string $name): Company
    {
        return $this->company::create(['name' => $name]);
    }
}
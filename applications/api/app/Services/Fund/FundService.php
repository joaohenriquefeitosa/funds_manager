<?php

namespace App\Services\Fund;

use App\Models\Fund;
use App\Repositories\Alias\AliasRepositoryInterface;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Fund\FundRepositoryInterface;
use App\Repositories\FundManager\FundManagerRepositoryInterface;

class FundService implements FundServiceInterface
{
    /**
     * @var FundRepositoryInterface
     */
    private $fundRepository;

    /**
     * @var FundManagerRepositoryInterface
     */
    private $fundManagerRepository;

    /**
     * @var AliasRepositoryInterface
     */
    private $aliasRepository;

    /**
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;

    /**
     * FundService constructor.
     * 
     * @param FundRepositoryInterface           $fundRepository
     * @param FundManagerRepositoryInterface    $fundManagerRepository
     * @param AliasRepositoryInterface          $aliasRepository
     * @param CompanyRepositoryInterface        $companyRepository
     */
    public function __construct(
        FundRepositoryInterface         $fundRepository,
        FundManagerRepositoryInterface  $fundManagerRepository,
        AliasRepositoryInterface        $aliasRepository,
        CompanyRepositoryInterface      $companyRepository
    )
    {
        $this->fundRepository           = $fundRepository;
        $this->fundManagerRepository    = $fundManagerRepository;
        $this->aliasRepository          = $aliasRepository;
        $this->companyRepository        = $companyRepository;
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
        return $this->fundRepository->index($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * 
     * @return array|null
     */
    public function show(int $id): ?array
    {
        return $this->fundRepository->show($id)->toArray();
    }

    /**
     * Return the specified object.
     *
     * @param int $id
     * 
     * @return Fund|null
     */
    public function find(int $id): ?Fund
    {
        return $this->fundRepository->show($id);
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
        if(!$this->show($id)){
            return;
        }
        
        $this->fundRepository->delete($id);
    }

    /**
     * Create the specified resource.
     *
     * @param array $data
     * 
     * @return Fund
     */
    public function create(array $data): ?Fund
    {
        try {            
            $fundManager = $this->fundManagerRepository->getFundManagerByName($data['manager']);
            if(!$fundManager) {
                $fundManager = $this->fundManagerRepository->create($data['manager']);
            }

            $aliases = $data['alias'] ?? [];
            $companies = $data['companies'] ?? [];
    
            unset($data['manager'], $data['alias'], $data['companies']);
            $data['manager_id'] = $fundManager['id'];
            
            $fund = $this->fundRepository->create($data);

            // Attach aliases to the fund
            foreach($aliases as $name) {
                $alias = $this->aliasRepository->getByName($name);
                if(!$alias) {
                    $this->aliasRepository->create(['alias' => $name, 'fund_id' => $fund->id]);
                }
            }

            // Attach companies to the fund
            foreach($companies as $name) {
                $company = $this->companyRepository->getByName($name);
                if(!$company) {
                    $company = $this->companyRepository->create($name);
                }
                $fund->companies()->attach($company->id);
            }
            
            $fund->load('manager', 'aliases', 'companies');
            return $fund;

        } catch (\Throwable $th) {
            return null;
        }
    }


    /**
     * Update a Fund and its related attributes.
     *
     * @param array $data
     * @param int $id
     * 
     * @return Fund|null
     */
    public function update(array $data, int $id): ?Fund
    {
        try {
            $fund = $this->find($id);

            if (!$fund) {
                return null; // Handle not found fund case
            }

            $manager = $data['manager'];
            $aliases = $data['alias'];
            $companies = $data['companies'];
            unset($data['manager'], $data['alias'], $data['companies']);

            $fund = $this->fundRepository->update($data, $id);

            if (isset($manager)) {
                $fundManager = $this->fundManagerRepository->getFundManagerByName($manager);
                if (!$fundManager) {
                    $fundManager = $this->fundManagerRepository->create($manager);
                }
                $fund->manager()->associate($fundManager);
            }

            if (isset($aliases)) {
                $fund->aliases()->delete();
                foreach ($aliases as $name) {
                    $this->aliasRepository->create(['alias' => $name, 'fund_id' => $fund->id]);
                }
            }

            if (isset($companies)) {
                $fund->companies()->detach();
                foreach ($companies as $name) {
                    $company = $this->companyRepository->getByName($name);
                    if(!$company) {
                        $company = $this->companyRepository->create($name);
                    }
                    $fund->companies()->attach($company->id);
                }
            }

            // Reload the updated relationships
            $fund->load('manager', 'aliases', 'companies');

            return $fund;

        } catch (\Throwable $th) {
            return null;
        }
    }
}
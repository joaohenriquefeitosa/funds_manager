<?php

namespace App\Repositories\Alias;

use App\Models\Alias;

class AliasRepository implements AliasRepositoryInterface
{
    /**
     * @var Alias
     */
    private $alias;

    /**
     * AliasRepository constructor.
     * 
     * @param Alias $Alias
     */
    public function __construct(Alias $alias)
    {
        $this->alias = $alias;
    }

    /**
     * Return a alias by name.
     * 
     * @param string $name
     * 
     * @return array|null
     */
    public function getByName(string $name): ?array
    {
        try {
            return $this->alias::where('alias', $name)->firstOrFail();            
        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * Create a new alias.
     * 
     * @param array $data
     * 
     * @return Alias
     */
    public function create(array $data): Alias
    {
        return $this->alias::create($data);
    }
}
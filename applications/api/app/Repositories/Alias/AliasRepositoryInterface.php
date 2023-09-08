<?php

namespace App\Repositories\Alias;

use App\Models\Alias;

interface AliasRepositoryInterface
{
    /**
     * Return a alias by name.
     * 
     * @param string $name
     * 
     * @return array|null
     */
    public function getByName(string $name): ?array;

    /**
     * Create a new alias.
     * 
     * @param array $data
     * 
     * @return Alias
     */
    public function create(array $data): Alias;
}
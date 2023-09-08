<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'start_year', 
        'manager_id'
    ];

    public function manager()
    {
        return $this->belongsTo(FundManager::class, 'manager_id');
    }

    public function aliases()
    {
        return $this->hasMany(Alias::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    /**
     * Scope a query to filter funds based on provided criteria.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $data
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, array $data)
    {
        if (isset($data['name'])) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        if (isset($data['fund_manager'])) {
            $query->whereHas('manager', function ($subquery) use ($data) {
                $subquery->where('name', 'like', '%' . $data['fund_manager'] . '%');
            });
        }

        if (isset($data['year'])) {
            $query->where('start_year', '=', $data['year']);
        }

        return $query;
    }
}

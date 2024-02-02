<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class View extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'address', 'date'];

    public function scopeCountByAddress(Builder $query, $profileId,$start, $end)
    {

        return $query->select(
            'address',
            DB::raw('COUNT(address) as count'),
        ) ->whereBetween('created_at', [$start, $end.' 23:59:59'])
            ->where('profile_id', $profileId)
            ->groupBy('address');

    }
}

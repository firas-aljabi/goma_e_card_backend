<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ViewLink extends Model
{
    use HasFactory;

    protected $fillable = ['primary_link_id', 'address', 'user_id'];

    protected $table = 'user_primary_links_views';

    public function scopeCountLinkByAddress(Builder $query, $start, $end, $UserId, $primaryLinkId)
    {

        return $query->select(
            'address',
            DB::raw('COUNT(address) as visit'),
        )
            ->whereBetween('created_at', [$start, $end.' 23:59:59'])
            ->where('user_id', $UserId)
            ->where('primary_link_id', $primaryLinkId)
            ->groupBy('address');

    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'userName',
        'email',
        'password',
        'uuid',
        'is_admin',
        'code',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function primary(): BelongsToMany
    {
        return $this->belongsToMany(PrimaryLink::class, 'user_primary_links')->withPivot('value');
    }

    public function links_views(): HasMany
    {
        return $this->hasMany(ViewLink::class, 'user_id', 'id');
    }

    public function count_links_views($start, $end)
    {
        $host = asset('');

        return $this->links_views()
            ->select('user_primary_links_views.primary_link_id', 'primary_links.name', DB::raw("CONCAT('$host', primary_links.logo) AS logo"), DB::raw('COUNT(primary_link_id) AS visit'))
            ->join('primary_links', 'primary_links.id', '=', 'user_primary_links_views.primary_link_id')
            ->whereBetween('user_primary_links_views.created_at', [$start, $end.' 23:59:59'])
            ->groupBy('user_primary_links_views.primary_link_id', 'primary_links.name', 'primary_links.logo')
            ->union(function ($query) use ($host) {
                $query->select('ul.primary_link_id', 'primary_links.name', DB::raw("CONCAT('$host', primary_links.logo) AS logo"),DB::raw('0 AS visit'))
                    ->join('primary_links', 'primary_links.id', '=', 'ul.primary_link_id')
                    ->from('user_primary_links AS ul')
                    ->whereNotExists(function ($subquery)  {
                        $subquery->select(DB::raw(0))
                            ->from('user_primary_links_views AS uvv')
                            ->whereRaw('ul.primary_link_id = uvv.primary_link_id');
                    })
                    ->where('ul.user_id', Auth::id());
            })
            ->get();

    }
}
//SELECT
//    uv.primary_link_id,
//    COUNT(uv.primary_link_id) AS visit
//FROM
//    `user_primary_links_views` AS uv
//WHERE
//    uv.user_id = 1
//GROUP BY
//    uv.primary_link_id
//UNION
//SELECT
//    ul.primary_link_id,
//    0 AS visit
//FROM
//    user_primary_links AS ul
//WHERE NOT
//    EXISTS(
//        SELECT
//        0
//    FROM
//        `user_primary_links_views` AS uvv
//    WHERE
//        ul.primary_link_id = uvv.primary_link_id
//)

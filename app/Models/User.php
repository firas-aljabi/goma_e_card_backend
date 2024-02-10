<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        $a =asset('');
        return $this->links_views()
            ->select('user_primary_links_views.primary_link_id', 'primary_links.name', DB::raw("CONCAT('$a', primary_links.logo) AS logo"), DB::raw('COUNT(primary_link_id) AS visit'))
            ->join('primary_links', 'primary_links.id', '=', 'user_primary_links_views.primary_link_id')
            ->whereBetween('user_primary_links_views.created_at', [$start, $end.' 23:59:59'])
            ->groupBy('user_primary_links_views.primary_link_id', 'primary_links.name', 'primary_links.logo')
            ->get();

    }
}

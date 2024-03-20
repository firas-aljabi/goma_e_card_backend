<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePrimaryLink extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'primary_link_id', 'views', 'value', 'available'];

    protected $table = 'user_primary_links';

    public function profile()
    {
        return $this->belongsTo(User::class);
    }
}

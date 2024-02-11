<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    public function setImageAttribute($image)
    {
        $newImageName = uniqid().'_'.'image'.'.'.$image->extension();
        $image->move(public_path('themes/'), $newImageName);

        return $this->attributes['image'] = '/themes/'.$newImageName;
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'themes_colors')->select('name');
    }
}

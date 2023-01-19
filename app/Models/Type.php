<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public  function getTypeWithSlug($name)
    {
        $this->setAttribute('slug', Str::slug($name));
        return $this;
    }
}

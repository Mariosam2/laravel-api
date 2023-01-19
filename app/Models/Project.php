<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'img', 'description', 'creation_date', 'type_id'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * The technologies that belong to the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }

    public  function getProjectWithSlug($title)
    {
        $this->setAttribute('slug', Str::slug($title));
        return $this;
    }
}

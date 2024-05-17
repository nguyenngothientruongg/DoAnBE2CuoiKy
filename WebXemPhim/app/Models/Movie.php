<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movie';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'movie_name',
        'describe',
        'category',
        'images',
        'video',
        'age_limit',
    ];

    public function user(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }

    public function posts(): HasMany {
        return $this->hasMany(Posts::class, 'id_movie');
    }
}

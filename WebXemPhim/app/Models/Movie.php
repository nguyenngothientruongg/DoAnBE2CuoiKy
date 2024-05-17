<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'id_countries'
    ];

    public function countries(): BelongsTo {
        return $this->belongsTo(Countries::class, 'id_countries');
    }

    public function user(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }

    public function posts(): HasMany {
        return $this->hasMany(Posts::class, 'id_movie');
    }

    public function movie_watched(): HasMany {
        return $this->hasMany(MovieWatched::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'movie_watched', 'id_movie', 'id_user')->withTimestamps();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'id_movie',
        'id_user',
        'comments',
    ];
    
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function movie(): BelongsTo {
        return $this->belongsTo(Movie::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Countries extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $fillable = [
        'name',
    ];

    public function movie(): HasMany {
        return $this->hasMany(Movie::class, 'id');
    }
}

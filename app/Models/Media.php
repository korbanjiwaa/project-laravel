<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'judul',
        'kategori',
        'tahun',
        'genre',
        'episode',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'episode' => 'integer',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

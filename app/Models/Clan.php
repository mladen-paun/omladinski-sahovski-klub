<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ime',
        'prezime',
        'godina_rodjenja',
        'fide_rejting',
        'kategorija_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'godina_rodjenja' => 'date',
            'fide_rejting' => 'float',
            'kategorija_id' => 'integer',
        ];
    }

    public function kategorija(): BelongsTo
    {
        return $this->belongsTo(Kategorija::class);
    }
}

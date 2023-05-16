<?php

namespace App\Models;

use App\Models\Serie;
use App\Models\Episode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['number'];

    public function series()
    {
        return $this->belongsTo(Serie::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    /**
     * Returns the number of watched episodes.
     *
     * @return int
     */
    public function numberOfWatchedEpisodes(): int
    {
        return $this->episodes->filter(fn($episode) => $episode->watched)->count();
    }
}

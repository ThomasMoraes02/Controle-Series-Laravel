<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Serie extends Model
{
    use HasFactory;

    /** @var array Somente os campos que serão preenchidos */
    protected $fillable = ['nome'];

    public function temporadas()
    {
        return $this->hasMany(Season::class);
    }
}

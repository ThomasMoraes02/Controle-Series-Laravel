<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    /** @var array Somente os campos que serão preenchidos */
    protected $fillable = ['nome'];
}

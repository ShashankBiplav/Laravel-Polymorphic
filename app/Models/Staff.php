<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(int $int)
 */
class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'imageable');
    }
}

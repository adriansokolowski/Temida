<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Person extends Model
{
    use HasFactory;

    public $table = 'people';

    public function films()
    {
        return $this->morphedByMany(Film::class, 'personable');
    }

    public function planets()
    {
        return $this->morphedByMany(Planet::class, 'personable');
    }

    public function getCreatedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d H:i') : null;
    }

    public function getEditedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d H:i') : null;
    }
}

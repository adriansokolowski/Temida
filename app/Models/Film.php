<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Film extends Model
{
    use HasFactory;

    public function people()
    {
        return $this->morphToMany(Person::class, 'personable');
    }
}

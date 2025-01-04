<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Bank extends Model
{
    use HasFactory;
    //

    public function admissions():HasMany
    {
        return $this->hasMany(Admission::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Degree extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function programs():BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'degree_program');
    }

    public function getTypeAttribute($value)
    {
        // Define a mapping of database values to human-readable text
        $types = [
            'matric' => 'Matric or Equivalent',
            'intermediate' => 'Intermediate or Equivalent',
            'ba' => 'BA/BSc or Equivalent',
            'ma' => 'MA/MSc / BS Hon\'s or Equivalent',
        ];

        // Return the human-readable value or a default value if the type is unknown
        return $types[$this->attributes['type']] ?? 'Unknown Type';
    }

    public function matriceducations():HasMany
    {
        return $this->hasMany(Matriceducation::class);
    }

    public function intereducations():HasMany
    {
        return $this->hasMany(Intereducation::class);
    }
    public function baeducations():HasMany
    {
        return $this->hasMany(Baeducation::class);
    }
    public function bseducations():HasMany
    {
        return $this->hasMany(Bseducation::class);
    }

}

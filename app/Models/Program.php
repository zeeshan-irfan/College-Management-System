<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function department():BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function degrees():BelongsToMany
    {
        return $this->belongsToMany(Degree::class, 'degree_program');
    }

    public function records():HasMany
    {
        return $this->hasMany(Record::class);
    }
}

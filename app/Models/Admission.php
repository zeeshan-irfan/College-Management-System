<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admission extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $casts = [
        'last_date' => 'date',
        'challan_last_date' => 'date',
    ];

    public function records():HasMany
    {
        return $this->hasMany(Record::class);
    }

    public function bank():BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}

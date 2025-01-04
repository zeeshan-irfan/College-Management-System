<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Record extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function admission():BelongsTo
    {
        return $this->belongsTo(Admission::class);
    }

    public function program():BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
    public function challan():HasOne
    {
        return $this->hasOne(Challan::class);
    }


}

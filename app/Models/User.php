<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function address():HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function personalinfo():HasOne
    {
        return $this->hasOne(Personal::class);
    }

    public function fatherinfo():HasOne
    {
        return $this->hasOne(Fatherinfo::class);
    }

    public function matriceducation():HasOne
    {
        return $this->hasOne(Matriceducation::class);
    }

    public function intereducation():HasOne
    {
        return $this->hasOne(Intereducation::class);
    }

    public function baeducation():HasOne
    {
        return $this->hasOne(Baeducation::class);
    }

    public function bseducation():HasOne
    {
        return $this->hasOne(Bseducation::class);
    }

    public function records():HasMany
    {
        return $this->hasMany(Record::class);
    }
    public function challans():HasMany
    {
        return $this->hasMany(Challan::class);
    }


}

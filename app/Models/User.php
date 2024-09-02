<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    use  HasFactory, Notifiable;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    // public function userTokens()
    // {
    //     return $this->hasMany(PersonalAccessToken::class, "tokenable_id");
    // }

    // public function checkIns()
    // {
    //     return $this->hasMany(CheckIn::class, 'user_id', 'id');
    // }

    /**
     * 近五筆的簽到記錄
     */
    // public function recentCheckIns()
    // {
    //     return $this->hasMany(CheckIn::class, 'user_id', 'id')->latest()->limit(5);
    // }

    // public function userImage()
    // {
    //     return $this->hasOne(UserImage::class, 'user_id', 'id');
    // }
}
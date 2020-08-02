<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{    
    use Notifiable, SoftDeletes, HasApiTokens;

    const VERIFIED_USER = '1'; 
    const UNVERIFIED_USER = '0';

    const ADMIN_USER = 'true'; 
    const REGULAR_USER = 'false'; 

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified', 'admin', 'verification_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isVerified()
    {
        return $this->verified == static::VERIFIED_USER;
    }

    public static function generateVerificationCode()
    {
        return Str::random(40);
    }

    public static function resourceCollection(Collection $collection)
    {
        return new UserCollection(UserResource::collection($collection));
    }
}

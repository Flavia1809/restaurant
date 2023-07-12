<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class User extends Authenticatable
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
        'username',
        'google_id',
//        'provider',
//        'provider_id',
//        'provider_token'
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
    protected $casts =
        [
        'password' => 'hashed',
    ];

    public static function generateUserName($username)
    {
        if($username == null)
        {
            $username =Str::lower(Str::random(8));
        }

        if(User::where('username', $username) -> exists())
        {
            $newUsername = $username.Str::lower(Str::random(3));
            $username = self::generateUserName($newUsername);
        }
        return $username;
    }

}

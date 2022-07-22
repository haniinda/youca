<?php
declare(strict_types=1);

namespace App\Models;

use App\Notifications\ResetPassNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'f-name', 'l-name',
        'email',
        'password'
        , 'picture',
        'phone', 'education', 'birth-date'
        , 'address', 'account_type',
        'email_verification_code'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'companie_id',
        'type-account_id',
        'created_at',
        'updated_at',
        'email_verification_code'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }


    public function advs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Advs::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        if ($this->account_type == "normal") {
            $url = 'https://spa.test/reset-password?token=' . $token;
            $this->notify(new ResetPassNotification($url));
        } else {
            $url = url('/reset-password') . "/" . $token;
            $this->notify(new ResetPassNotification($url));
        }

    }

    public function role()
    {
        return $this->belongsTo(Role::class, "role_id");
    }

    public function hasPermission($permission)
    {
        if ($this->role == null) {
            return false;
        }
        return $this->role->permission()->where("permit", $permission)->count() > 0;
    }

}

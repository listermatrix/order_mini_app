<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillable = ['first_name', 'middle_name', 'last_name', 'email', 'username', 'password', 'must_change_password'];



    public function account()
    {
        return $this->hasMany(Account::class);
    }

    public function sent()
    {
        return $this->hasMany(Transaction::class);
    }


    public function received()
    {
       return Transaction::query()->where('target_user_id',$this->id)->get();
    }




    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    public function log($message) {
        $message = ucwords($message);
        AuditTrail::query()->create([
            'user_id'   => $this->id,
            'username'  => $this->username,
            'date'      => Carbon::now()->toDateTimeString(),
            'activity'  => $this->first_name.' '.$this->last_name. ": {$message}"
        ]);
    }
}

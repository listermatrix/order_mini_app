<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;



    protected $fillable = [
        'user_id',
        'source_currency_id',
        'target_currency_id',
        'target_user_id',
        'rate',
        'amount_transferred',
        'status',
        'amount_received',
    ];


    public function sender()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function receiver()
    {
        return $this->belongsTo(User::class,'target_user_id');
    }


    public function target_currency()
    {
        return $this->belongsTo(Currency::class,'target_currency_id');
    }



    public function source_currency()
    {
        return $this->belongsTo(Currency::class,'source_currency_id');
    }
}

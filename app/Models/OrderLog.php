<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLog extends Model
{
    use HasFactory;
    use SoftDeletes;



    protected $fillable = [
        'order_id',
        'status',
        'message',
        'user_id',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}

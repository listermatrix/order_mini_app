<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'box_id',
        'items',
        'amount',
        'date',
        'picking_product',
        'shipping_company',
        'shipping_tracking_number',
        'shipping_label',
        'status',
    ];


    public function log($message)
    {
        OrderLog::query()->create([
            'order_id' => $this->id,
            'status' => $this->status,
            'message' => $message,
            'user_id' => auth()->user()->id ?? null,
        ]);
    }


    public function logs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderLog::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExchangeRate extends Model
{
    use HasFactory;
    use SoftDeletes;




    public function source()
    {
        return $this->belongsTo(Currency::class,'source_currency');
    }


    public function target()
    {
        return $this->belongsTo(Currency::class,'target_currency');
    }
}

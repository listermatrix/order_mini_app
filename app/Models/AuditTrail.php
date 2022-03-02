<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $fillable = [
        'user_id', 'username', 'date', 'activity'
    ];


    protected $table = 'audit_trails';

    protected $dates = ['date'];
}


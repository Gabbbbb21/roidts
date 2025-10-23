<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'request_id',
        'fname',
        'mname',
        'lname',
        'doc_type',
        'notes',
        'action',
        'origin_user',
        'origin_division',
        'new_division',
        'new_user',
        'urgent',
    ];
}

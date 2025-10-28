<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function history(): HasMany
    {
        return $this->hasMany(RequestHistory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

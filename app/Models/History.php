<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'random_number',
        'sum',
        'win',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

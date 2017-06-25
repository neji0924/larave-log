<?php

namespace Neji0924\Log;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $casts = [
        'before' => 'json',
        'after'  => 'json',
    ];

    protected $fillable = ['ip', 'before', 'after'];

    public function loggable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

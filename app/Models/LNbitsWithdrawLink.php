<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LNbitsWithdrawLink extends Model
{
    protected $table = 'lnbits_withdraw_links';

    protected $casts = [
        'valid_until' => 'datetime',
    ];

    protected $fillable = [
        'lnbits_id',
        'wallet',
        'title',
        'valid_until',
        'min_withdrawable',
        'max_withdrawable',
        'uses',
        'used',
        'wait_time',
        'is_unique',
        'unique_hash',
        'open_time',
        'lnurl',
        'valid_until',
    ];
}

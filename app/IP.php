<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IP extends Model
{
    protected $table = "i_ps";

    protected $fillable = [
        'ip', 'bogon', 'city', 'region', 'country', 'loc', 'postal',
    ];
}

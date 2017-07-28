<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'ip', 'time', 'agent', 'host', 'scheme', 'uri',
    ];
}

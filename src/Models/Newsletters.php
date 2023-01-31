<?php

namespace Indianic\Newsletters\Models;

// use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Newsletters extends Model {

    protected $casts = [
        'date_time' => 'datetime',
    ];

}

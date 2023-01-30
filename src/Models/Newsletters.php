<?php
namespace Indianic\Newsletters\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletters extends Model {

    use HasFactory, HasUlids;

    protected $casts =[
    'date_time'=>'datetime',
    ];

}

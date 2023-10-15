<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $attributes = [
        'period' => 0,
        'period_type' => 'день',
        'date' => '11-12-2023'
    ];
}

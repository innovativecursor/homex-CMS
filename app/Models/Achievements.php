<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievements extends Model
{
    protected $fillable = [
        'description',
        'label1',
        'counter1',
        'label2',
        'counter2',
        'label3',
        'counter3',
    ];
}

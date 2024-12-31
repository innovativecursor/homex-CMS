<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'about_title',
        'description',
        'subdescription',
        'our_values1',
        'our_values2',
        'our_values3',
        'our_values4',
        'about_image1',  // Add to the fillable array
        'about_image2',  // Add to the fillable array
    ];

}

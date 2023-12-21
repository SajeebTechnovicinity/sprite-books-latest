<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_name',
        'app_logo',
        'terms_and_condition',
        'privacy_policy',
        'mobile',
        'email',
        'hero_title',
        'hero_description',
        'hero_image',
        'section1_text',
        'section1_image',
        'section2_heading',
        'section2_image',
        'section2_icon1',
        'section2_icon1_text',
        'section2_icon2',
        'section2_icon2_text',
        'section2_icon3',
        'section2_icon3_text',
        'section2_icon4',
        'section2_icon4_text',
        'section3_heading',
        'section3_details',
        'section3_image',
        'section4_text',
        'section4_details',
        'section4_button_text',
        'section4_button_url',
        'section2_icon1_details',
        'section2_icon2_details',
        'section2_icon3_details',
        'section2_icon4_details',
    ];
}

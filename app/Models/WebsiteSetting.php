<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'restaurant_name', 'logo', 'hero_image', 'about_image', 'primary_color', 'hero_title', 'hero_subtitle',
        'about_text', 'contact_email', 'phone', 'address', 'theme_name',
        'footer_text',
        'facebook_link',
        'instagram_link',
    ];
    //
}

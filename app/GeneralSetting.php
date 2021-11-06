<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    public $fillable = ['site_name', 'site_title', 'meta_title', 'meta_keywords', 'meta_description', 'site_subtitle', 'site_desc', 'site_footer'];
}

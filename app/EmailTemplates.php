<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{
    public $fillable = ['email_type','email_name', 'email_subject', 'email_body', 'header_image', 'status', 'created_at', 'updated_at'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Howtobuys extends Model
{
    public $fillable = ['title', 'content', 'image', 'sign_date'];

    public $table = 'howtobuys';
}

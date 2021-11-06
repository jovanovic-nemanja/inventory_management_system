<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Howtosells extends Model
{
    public $fillable = ['title', 'content', 'image', 'sign_date'];

    public $table = 'howtosells';
}

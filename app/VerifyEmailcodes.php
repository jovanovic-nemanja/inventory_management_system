<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class VerifyEmailcodes extends Model
{
    public $fillable = ['email','name', 'phone','country','verify_code', 'password'];

    public $table = 'verify_emailcodes';
}

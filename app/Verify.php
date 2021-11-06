<?php

namespace App;

use App\Verify;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Verify extends Model
{
    public $fillable = ['document', 'comment', 'userid', 'sign_date'];

    public $table = 'verify';

	/**
	* upload document for verify user
	* @param $userid
	* @author Nemanja
	* @since 2020-12-14
	*/    
    public static function upload_document($verify_id, $existings = null) {
        if(!request()->hasFile('document')) {
            return false;
        }

        Storage::disk('public_local')->put('uploads/', request()->file('document'));

        self::saveDoc($verify_id, request()->file('document'));
    }

    public static function saveDoc($verify_id, $doc) {
        $verify = Verify::where('id', $verify_id)->first();

        if(@$verify) {
            Storage::disk('public_local')->delete('uploads/', $verify->document);
            $verify->document = $doc->hashName();
            $verify->update();
        }
    }
}

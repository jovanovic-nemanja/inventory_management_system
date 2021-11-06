<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Image extends Model
{

	public $fillable = ['url', 'product_id'];

    public function product() {
    	return $this->belongsTo('App\Product');
    }

    /**
    * @param product_id
    * This is a feature to upload a Product image
    */
    public static function upload_product_images($product_id, $existings = null) {
        if(!request()->hasFile('images')) {
            return false;
        }

        Storage::disk('public_local')->put('uploads/', request()->file('images'));
        self::save_image($product_id, request()->file('images'));
    }

    /**
    * @param product_id
    * This is a sub-feature to upload a Product image
    */
    public static function save_image($product_id, $image) {
        $img = Image::where('product_id', $product_id)->first();
        print_r($image); exit;

        if($img) {
            Storage::disk('public_local')->delete('uploads/', $img->url);
            $img->url = $image->hashName();
            $img->save();
        } else {
            $img = Image::create([
                'url' => $image->hashName(),
                'product_id' => $product_id,
            ]);
        }

        return $img;
    }

    /**
    * @param user_id
    * This is a feature to upload a company logo
    */
    public static function upload_logo_img($user_id, $existings = null) {
        if(!request()->hasFile('company_logo')) {
            return false;
        }

        Storage::disk('public_local')->put('uploads/', request()->file('company_logo'));

        self::save_logo_img($user_id, request()->file('company_logo'));
    }

    public static function save_logo_img($user_id, $image) {
        $user = User::where('id', $user_id)->first();

        if($user) {
            Storage::disk('public_local')->delete('uploads/', $user->company_logo);
            $user->company_logo = $image->hashName();
            $user->update();
        }
    }
}
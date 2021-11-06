<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Image;

class ImageController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {

        if($image->product->user_id == auth()->id())
        {
            $image->delete();
        }

        return response()->json(['msg' => 'Successfully deleted!', 'status' => '200']);
    }

    public function deleteimage($id)
    {
        $record = Image::where('id', $id)->first();
        $product_id = $record->product_id;
        Image::where('id', $id)->delete();
        $images = Image::where('product_id', $product_id)->get();

        return response()->json(['msg' => 'Successfully deleted!', 'status' => '200', 'data' => $images]);
    }
}

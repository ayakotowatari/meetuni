<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Storage;

class ImagesController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'image' => 'required | image'
         ]);

        $image = $request->file('image');
        $disk = Storage::disk('local');
        // [Tips]設定をすれば下記に書き換えるだけでS3に保存できる
        // $disk = Storage::disk('s3');

        $path = $disk->put('image', $image);

        dd($path);

        $storeimage = new Image();
        $storeimage->image = $path; 

        $storeimage->save();

    }
}

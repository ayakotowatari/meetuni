<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Storage;
use Validator;

class ImagesController extends Controller
{
    public function index()
    {
        return view('inst.test');
    }
    
    public function store(Request $request){

        $request->validate([
            'image' => 'required | image'
         ]);

        $image = $request->file('image');
        $disk = Storage::disk('local');
        // [Tips]設定をすれば下記に書き換えるだけでS3に保存できる
        // $disk = Storage::disk('s3');

        $path = $disk->put('public', $image);

        $filename = ltrim($path, 'public/');

        $storeimage = new Image();
        $storeimage->image = $filename; 

        $storeimage->save();

    }

    public function imagePost(Request $request){

        $validator = Validator :: make ( $request -> all (), [
            'image' => 'required|image|max:5000' //動画の容量を決める->5MB
            ]);
            //バリデーション:エラー
            if ( $validator -> fails ()) {
            return redirect ()-> back ()
            -> withInput ()
            -> withErrors ( $validator );
            }
            $image = $request -> file ('image');
            $disk = Storage :: disk ('local');
            // [Tips]設定をすれば下記に書き換えるだけでS3に保存できる
            // $disk = Storage::disk('s3');
            //putはオリジナルの文字列で保存してくれる。
            //(第一引数：保存場所、第二引数：画像ファイル)
            $path = $disk -> put ('public', $image);

            //putAsは自分で名前を決められる
            //（第一引数：保存場所、第二引数：画像ファイル、第三引数：ファイル名）
            // $path = $disk -> putFileAs ( 'test' , $image , 'なんでも.png' );
            // dd ( $path );
            //この$pathをDBに保存してそれを呼び出す。

        $storeimage = new Image();
        $storeimage->image = $path;

        $storeimage->save();

    }

    public function displayImage(){

        $image = Image::where('images.id', '22')->first();

        return response()->json(['image'=>$image],200);

    }
    
    public function testshow(){
        
        return view ('inst.anothertest');
    }
}

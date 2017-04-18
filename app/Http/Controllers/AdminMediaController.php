<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminMediaController extends Controller
{
    //
    public function index(){
        $images = Photo::all();

        return view('admin.media.index', compact('images'));
    }

    public function upload(){
        return view('admin.media.upload');
    }

    public function store(Request $request){
        $file = $request->file('file');
        $name = time().$file->getClientOriginalName();

        $file->move('images', $name);

        Photo::create(['path'=>$name]);
    }

    public function destroy($id){}
}

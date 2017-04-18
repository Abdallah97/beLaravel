<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminMediaController extends Controller
{
    //
    public function index(){
        return view('admin.media.index');
    }

    public function upload(){
        return view('admin.media.upload');
    }

    public function store(Request $request){}

    public function destroy($id){}
}

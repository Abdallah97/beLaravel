<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::lists('name', 'id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        $user = Auth::user();
        $input = $request->all();

        if($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();

            $file->move('images', $name);
            $photo = Photo::create(['path'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $user->posts()->create($input);

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $categories = Category::lists('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::findOrFail($id);
        $input = $request->all();

        if($file = $request->file('photo_id')){
            //Only get in this selection if the edit page receives a new picture
            $name = time().$file->getClientOriginalName();

            if($post->photo_id !== 0){{
                //Update if there's a picture previously
                $photo = Photo::findOrFail($post->photo_id);
                $oldName = $photo->path;

                unlink(public_path().$oldName);

                $photo->path = $name;
                $photo->update();
            }}
            else {
                //Update if there's no picture previously
                $photo = Photo::create(['path'=>$name]);
            }
            $file->move('images', $name);

            $input['photo_id'] = $photo->id;
        }
        //If there is no picture inputted in the edit page, it will straight up
        //update the data in table
        $post->update($input);

        //It can also be updated like this
        //(though the way you get the old photo data have to be changed too)
        //Auth::user()->posts()->whereId($id)->first()->update($input)

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);

        //If the post have a image attach to it, it will enter
        //this condition
        if($post->photo_id !== null){
            $photo = Photo::findOrFail($post->photo_id);
            $oldName = $photo->path;

            //Deleting the image from the images folder
            unlink(public_path().$oldName);

            //Delete the image record from photos table
            $photo->delete();
        }
        $postTitle = $post->title;

        //Deleting the post
        $post->delete();

        //Flashing message that the post has been successfully deleted
        Session::flash('deleted_post', $postTitle.' has been deleted!');

        return redirect('/admin/posts');
    }

    public function post($id){
        $post = Post::findOrFail($id);
        $comments = $post->comments->where('is_active', 'Displayed');

        return view('post', compact('post', 'comments'));
    }
}

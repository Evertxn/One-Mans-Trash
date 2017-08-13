<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Post::where('title', 'Post Two')->get();
        //$posts = Post::orderBy('title','desc')->get();

        $posts = Post::orderBy('created_at','desc')->paginate(5);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            //default upload size 2.0 (default apache upload size)
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //file uploading
        if($request->hasFile('cover_image')){
            // grab filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // grab just the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // grab just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // filename to store (unique)
            $fileNameToStore = $filename.'_'.time().".".$extension;

            // upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }else{

            $fileNameToStore = 'noimage.jpg';
        }
        //end file uploading

        //create a post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized');
        }

        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        //file uploading
        if($request->hasFile('cover_image')){
            // grab filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

            // grab just the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // grab just the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // filename to store (unique)
            $fileNameToStore = $filename.'_'.time().".".$extension;

            // upload the image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }
        //end file uploading

        //create a post
        $post = Post::find($id);

        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized');
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            if($post->cover_image != 'noimage.jpg'){
                Storage::delete('public/cover_image/'.$post->cover_image);
            }
                $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Your post has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized');
        }

        if($post->cover_image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Your post has been deleted.');
    }
}

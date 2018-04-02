<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Model\User\post;
use App\Model\User\category;
use App\Model\User\tag;


class PostController extends Controller
{
     // Middleware for Admin
     public function __construct()
     {
         $this->middleware('auth:admin');
     }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::orderBy('created_at','DESC')->get();
        return view('admin.post.index',compact('posts')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags =tag::all();
        $categories =category::all();
        return view('admin.post.create',compact('tags','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'image' => 'nullable|max:1999',
            ]);

        //Handle file upload
        if($request->hasFile('image'))
        {
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        //Create new post
        $post = new post;
        $post->image = $fileNameToStore;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = $request->status;
        $post->save();
        // Many to many relation between Posts and Tags
        $post->tags()->sync($request->tags);
        // Many to many relation between Posts and Categories
        $post->categories()->sync($request->categories);
        return redirect(route('post.index'))->with('message', 'Added Post Successfully!!!!');
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
        $post = post::with('tags','categories')->where('id',$id)->first();
        $tags =tag::all();
        $categories =category::all();
        return view('admin.post.edit',compact('tags','categories','post'));
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
        $this->validate($request,[
            'title'=>'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'image'=>'nullable|max:1999'
            ]);
       //Handle file upload
        if($request->hasFile('image'))
        {
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else
        {
            $fileNameToStore = 'noimage.jpg';
        }
        //Update file
        $post = post::find($id); 
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = $request->status;
        if($request->hasFile('image'))
        {
            // Delete the old image if it's changed .
            if ($post->image != 'no_image.png') 
            {
                Storage::delete('public/images/'.$post->image);
            }
            $post->image = $fileNameToStore;
        }
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);
        $post->save();
        return redirect(route('post.index'))->with('message', 'Updated Post Successfully!!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = post::find($id);
        //Delete image from post
        if($posts->image != 'noimage.jpg')
        {
            Storage::delete('public/images/'.$posts->image);
        }
        //$posts->categories()->detach();
        //$posts->tags()->detach();
        $posts->delete();
        return redirect(route('post.index'))->with('message', 'Deleted Post Successfully!!!!');
    }
}

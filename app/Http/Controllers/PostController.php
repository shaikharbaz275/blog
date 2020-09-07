<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use App\Utilities\FileUpload;

class PostController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->category_id))
        {
        $categories = Category::all();
        $posts      = Post::where('category_id',$request->category_id)->with('category')->paginate(6);
        return view('post.index', compact('posts','categories'));
        }
        else {
        $categories = Category::all();
        $posts      = Post::with('category')->paginate(6);
        return view('post.index', compact('posts','categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'images' => 'required',
            'auther' => 'required',
            'description' => 'required'
        ]);

        $fileupload     = new FileUpload();
        $data['images'] = $fileupload->upload($data['images']);
        Post::create($data);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'auther' => 'required',
            'images' => 'nullable',
            'description' => 'required'
        ]);

        if (isset($data['images'])) {
            $fileupload = new FileUpload();
            $data['images'] = $fileupload->upload($data['images']);
        } else {
            $data['images'] = $post->images;
        }
        
        $post->update($data);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
       $post->delete();
       return back();
    }

    /**
     * this function image delete
     */

    public function imageDelete(Request $request, Post $post)
    {
        $images = $post['images'];
        $index = array_search($request['image'], $images);
        $removeimage = array_splice($images, $index, 1);
        $post['images'] = $images;
        unlink(public_path("/upload/$removeimage[0]"));
        $post->save();
        return back();
    }

}

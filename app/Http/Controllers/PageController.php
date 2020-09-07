<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    

    public function index(Request $request)
    {
       
        $categories = Category::all();
        $posts      = Post::with('category')->paginate(6);
        return view('welcome', compact('posts','categories'));

    }


    public function categoryIndex(Request $request)
    {
        $categories = Category::all();
        $posts      = Post::where('category_id',$request->id)->with('category')->paginate(6);
        return view('welcome', compact('posts','categories'));

    }

    public function view(Request $request)
    {
        return view('view');
    }

    public function viewPost(Post $post)
    {
        $categories = Category::all();
        return view('view',compact('post','categories'));
    }
}

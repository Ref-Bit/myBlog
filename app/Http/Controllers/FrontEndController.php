<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Setting;
use App\Tag;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    //
    public function index(){
        return view('index')
            ->with('title', Setting::first()->site_name)
            ->with('categories', Category::take(3)->get())
            ->with('first_post', Post::orderBy('created_at', 'desc')->first())
            ->with('second_post', Post::orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first())
            ->with('third_post', Post::orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first())
            ->with('engineering', Category::findOrFail(3))
            ->with('web_dev', Category::findOrFail(1))
            ->with('drawings', Category::findOrFail(2))
            ->with('settings', Setting::first());
    }

    public function singlePost($slug){
        $post = Post::where('slug', $slug)->first();

        $next_id = Post::where('id', '>', $post->id)->min('id');

        $prev_id = Post::where('id', '<', $post->id)->max('id');

        return view('single')->with('post', $post)
                                    ->with('title', $post->title)
                                    ->with('categories', Category::take(3)->get())
                                    ->with('next', Post::find($next_id))
                                    ->with('prev', Post::find($prev_id))
                                    ->with('tags', Tag::all())
                                    ->with('settings', Setting::first());
    }

    public function category($id){
        $category = Category::find($id);
        return view('category',compact('category'))
                                    ->with('title', $category->name)
                                    ->with('settings', Setting::first())
                                    ->with('categories', Category::take(5)->get());
    }
    public function tag($id){
        $tag = Tag::find($id);
        return view('tag',compact('tag'))
            ->with('title', $tag->tag)
            ->with('settings', Setting::first())
            ->with('categories', Tag::take(5)->get());
    }
}

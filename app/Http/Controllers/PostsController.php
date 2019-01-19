<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Setting;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.post.index')->with('posts', Post::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();
        if($categories->count() == 0 || $tags->count() ==0){

            Session::flash('info', 'You must have a category and a tag first!');

            return redirect()->route('posts');
        }
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            'title'=>'required|max:255',
            'featured'=>'required|image',
            'content'=>'required',
            'category_id'=>'required',
            'tags'=>'required',
        ]);

        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/posts', $featured_new_name);

       $post = Post::create([
            'title'=>$request->title,
            'content'=>$request->content,
            'featured'=>'uploads/posts/'. $featured_new_name,
            'category_id'=>$request->category_id,
           'slug'=>str_slug($request->title),
           'user_id'=>Auth::id(),
        ]);

       $post->tags()->attach($request->tags);

        Session::flash('success', 'Post Created Successfully');

        return redirect()->route('posts');
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

        return view('admin.post.edit', compact('post'))->with('tags', Tag::all())
                                                                     ->with('categories', Category::all());
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
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('featured')){
            $featured = $request->featured;
            $featured_new_name = time(). $featured->getClientOriginalName();
            $featured->move('uploads/posts', $featured_new_name);
            $post->featured = 'uploads/posts/'. $featured_new_name;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();
        $post->tags()->sync($request->tags);

        Session::flash('success', 'The Post Updated Successfully');

        return redirect()->route('posts');

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
        $post->delete();

        Session::flash('success', 'The post was just trashed.');

        return redirect()->back();
    }

    public function trash(){
        $posts = Post::onlyTrashed()->get();

        return view('admin.post.trashed', compact('posts'));
    }

    public function kill($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();

        Session::flash('success', 'The Post Deleted Permanently');

        return redirect()->back();
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        Session::flash('success', 'The Post Restored Successfully');

        return redirect()->route('posts');

    }

    public function results(){
        $posts = Post::where('title', 'like', '%'. request('query') .'%')->get();
        return view('results',compact('posts'))
            ->with('title', 'Search Results:' .request('query'))
            ->with('categories', Category::take(3)->get())
            ->with('settings', Setting::first())
            ->with('query', request('query'));
    }

}

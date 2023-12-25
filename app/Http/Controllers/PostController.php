<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

     $users = Post::get();
     return view ('index',compact('users'));

    }

    public function getCategory(Request $request){
        $tags=['tags'];
        if($search=$request->name){
            $tags=Category::where('title','Like',"%$search%")->get();

        }
        return response()->json($tags);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'title'=>'required',
            'description'=>'required',
            'tags'=>'required',
        ]);
        $data['tags']=json_encode($request->tags);
        Post::create($data);

        return back()->with('success','The post has been successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
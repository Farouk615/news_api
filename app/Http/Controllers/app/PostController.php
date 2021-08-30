<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostsRessources;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\CommentsRessources;
use App\Http\Resources\PostRessources;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return new PostsRessources($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required',
                'content'=>'required',
                'category_id'=>'required',
        ]
        );
        $user = $request->user();
        $post = new Post();
        $post->title=$request->get('title');
        $post->content=$request->get('content');
        if ( intval($request->get('category_id'))!=0){
            $post->category_id= intval($request->get('category_id'));
        }
        else {
            echo 'failed in category id';
        }
        $post->vote_up=0;
        $post->vote_down=0;
        $post->date_written= Carbon::now()->toDateTimeString();
        $post->save();
        return new PostRessources($post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::with(['comments','author','Category'])->where('id',$id)->get();
        return new PostRessources($post);
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
        $post = Post::find($id);

        if ($request->has('title')){
            $post->title=$request->get('title');
        }
        if ($request->has('content')){
            $post->content=$request->get('content');
        }


        if($request->has('category_id')) {
            if (intval($request->get('category_id')) != 0) {
                $post->category_id = intval($request->get('category_id'));
            } else {
                echo 'failed in category id';
            }

            $post->save();
            return new PostRessources($post);
        }}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Post::destroy($id);
    }
    public function comments($id){
        $post = Post::find($id);
        $comments = $post->comments()->paginate(10);
        return new CommentsRessources($comments);
    }
}

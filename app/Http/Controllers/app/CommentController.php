<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentRessources;
use App\Models\Comments;
use App\Models\Post;
use Carbon\Carbon;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Http\Request;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function store(Request $request , $id)
    {
        $request->validate([
            'content'=>'required',
        ]);
        if ( Post::find($id)){
            $comment = new Comments();
            $comment->content=$request->get('content');
            $comment->post_id=$id;
            $comment->date_written= Carbon::now()->toDateTimeString();
            $comment->user_id=$request->user()->id;
            $comment->save();
            return new CommentRessources($comment);
        }
        else
            return 'Post not found';

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comments::destroy($id);
    }

}

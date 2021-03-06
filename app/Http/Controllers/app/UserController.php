<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorCommentsRessources;
use App\Http\Resources\AuthorPostRessources;
use App\Http\Resources\TokenRessources;
use App\Http\Resources\UserIdRessources;
use App\Http\Resources\UserRessources;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return new UserRessources($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return UserIdRessources
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
                'email'=>'required',
                'password'=>'required',
            ]
        );
        $user = new User();
        $user -> name = $request->get('name');
        $user -> email = $request->get('email');
        $user -> password = Hash::make($request->get('password'));
        $user -> save();
        return new UserIdRessources($user);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    return new UserIdRessources(User::find($id));
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
        $user = User::find($id);
        if ($request->has('name')){
            $user->name=$request->get('name');
        }
        if($request->has('avatar')){
            $user->avatar=$request->get('avatar');
        }
        return new UserIdRessources($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

    }
    public function posts($id){
        $user = User::find($id);
        $posts = $user->posts()->paginate(5);
        return new AuthorPostRessources($posts);
    }
    public function comments($id){
        $user = User::find($id);
        $comments = $user->comments()->paginate(5);
        return new AuthorCommentsRessources($comments);
    }

    public function getToken(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)){
            $user=User::where('email',$request->get('email'))->first();
            return new TokenRessources(['token'=>$user->api_token]);
        }
        return 'user not found';
    }
}

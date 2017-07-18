<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;
use Auth;

use App\Comment;
use App\Article;

class CommentsController extends SiteController
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','comment_post_ID ');

        $data['article_id']=$request->input('comment_post_ID');
        $data['parent_id']=$request->input('comment_parent');

        $validator=Validator::make($data,[
            'article_id'=>'integer|required',
            'parent_id'=>'integer|required',
            'text'=>'string|required',
        ]);

        $validator->sometimes(['name','email','site'],'required|max:255',function ($input){
            return (!Auth::check());
        });

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $user=Auth::user();

        $comment=new Comment($data);

        if($user){
            $comment->user_id=$user->id;
        }


        $article=Article::find($data['article_id']);

        $article->comments()->save($comment);

        $comment->load('user');
        $data['id']=$comment->id;
        $data['email']=(!empty($data['email'])?$data['email']:$comment->user->email);
        $data['name']=(!empty($data['name'])?$data['name']:$comment->user->name);

        $viewComment=view(env('THEME').'.responseComment')->with('data',$data)->render();

        return response()->json(['success'=>true,'comment'=>$viewComment,'data'=>$data]);
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
        //
    }
}

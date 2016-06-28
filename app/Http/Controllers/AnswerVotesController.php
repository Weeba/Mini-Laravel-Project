<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
Use App\Answer;
use App\User;
Use App\AnswerVote;
Use Auth;


class AnswerVotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Answer $answer)
    {
        
        $user = Auth::user();
        $checker = AnswerVote::where('answer_id',   $answer->id)->where('user_id', $user->id)->get();
        $upvote = $answer->upvote;

        if($checker->count()==1){
            foreach($checker as $checkers){
                if($checkers->status==0){    
                    $answer->upvote = $upvote + 1;
                    $answer->save();
                    $checkers->status = 1;
                    $checkers->save();
                    return "<span class='glyphicon glyphicon-heart' aria-hidden='true' style='color:red'></span>".$answer->upvote;
                }
                
                elseif($checkers->status==1){
                    $answer->upvote = $upvote - 1;
                    $answer->save();
                    $checkers->status = 0;
                    $checkers->save();
                    return "<span class='glyphicon glyphicon-heart' aria-hidden='true' style='color:black'></span>".$answer->upvote;

                }
            }   
        }
        else{
            $new = new AnswerVote([
                'user_id' => $user->id,
                'answer_id' => $answer->id,   
            ]);
            $new->save();
            $answer->upvote = $upvote + 1;
            $answer->save();
            return "<span class='glyphicon glyphicon-heart' aria-hidden='true' style='color:red'></span>".$answer->upvote;

        }
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
        $user = Auth::user();
        $checker = AnswerVote::where('answer_id', $request->answers_id)->where('user_id', $user->id)->get();
        $answer = Answer::find($request->answers_id);
        $upvote = $answer->upvote;
        if($checker->count()==1){
            foreach($checker as $checkers){
                if($checkers->status==0){    
                    $answer->upvote = $upvote + 1;
                    $answer->save();
                    $checkers->status = 1;
                    $checkers->save();
                }
                elseif($checkers->status==1){
                    $answer->upvote = $upvote - 1;
                    $answer->save();
                    $checkers->status = 0;
                    $checkers->save();
                }
            }   
        }
        else{
            $answer->upvote = $upvote + 1;
            $answer->save();
            $upvote = new AnswerVote([
                'user_id' => $user->id,
                'answer_id' => $request->answers_id,   
            ]);
            $upvote->save();
        }
        return back();
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

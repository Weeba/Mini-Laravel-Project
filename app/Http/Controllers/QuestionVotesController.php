<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
Use App\Question;
use App\User;
Use App\QuestionVote;
Use Auth;


class QuestionVotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        // return $question;

        $user = Auth::user();
        // return $request->question_id;
        $checker = QuestionVote::where('question_id', $question->id)->where('user_id', $user->id)->get();
        $upvote = $question->upvote;
        if($checker->count()==1){
            foreach($checker as $checkers){
                if($checkers->status==0){    
                    $question->upvote = $upvote + 1;
                    $question->save();
                    $checkers->status = 1;
                    $checkers->save();
                    return "<span class='glyphicon glyphicon-heart' aria-hidden='true' style='color:red'></span>".$question->upvote;
                }
                elseif($checkers->status==1){
                    $question->upvote = $upvote - 1;
                    $question->save();
                    $checkers->status = 0;
                    $checkers->save();
                    return "<span class='glyphicon glyphicon-heart' aria-hidden='true' style='color:black'></span>".$question->upvote;
                }
            }   
        }
        else{
            $new = new QuestionVote([
                'user_id' => $user->id,
                'question_id' => $question->id,   
            ]);
            $new->save();
            $question->upvote = $upvote + 1;
            $question->save();
            return "<span class='glyphicon glyphicon-heart' aria-hidden='true' style='color:red'></span>".$question->upvote;
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
    public function store(Request $request, Question $question)
    {
        // return $question;
        // return $request->question_id;
        $user = Auth::user();
        // return $request->question_id;
        $checker = QuestionVote::where('question_id', $request->question_id)->where('user_id', $user->id)->get();
        // $question = Question::find($request->question_id);
        $upvote = $question->upvote;
        if($checker->count()==1){
            foreach($checker as $checkers){
                if($checkers->status==0){    
                    $question->upvote = $upvote + 1;
                    $question->save();
                    $checkers->status = 1;
                    $checkers->save();
                }
                elseif($checkers->status==1){
                    $question->upvote = $upvote - 1;
                    $question->save();
                    $checkers->status = 0;
                    $checkers->save();
                }
            }   
        }
        else{
             $question->upvote = $upvote + 1;
            $question->save();
            $upvote = new QuestionVote([
                'user_id' => $user->id,
                'question_id' => $request->question_id,   
            ]);
            $upvote->save();
        }
        return $question->upvote;
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use App\Answer;
use App\User;
use Auth;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users =  User::all()->with('answers')->get();
        // return $uses;
        // $questions = Question::all();
        // return view('question.show', compact('questions'));
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
        $this->validate($request, [
            'body' => 'required',
        ]);
        $body = strip_tags($request->body);
        // return $request->category_id;
        $answer = new Answer([
            'body' => $body,
            'question_id' => $request->question_id,   
            'user_id' => $user->id,
        ]);
        $answer->save();
        $question = Question::find($request->question_id);
        $number =  $question->answer;
        $question->answer = $number+1;
        $question->save();
        return back();
        // $users = User::with('aswers')->get();
        // return $users;
        // foreach($users as $user){
        //     foreach($user->answers as $answers){
        //         if($answers->question_id == $request->question_id){
                    
        //         }
        //     }
        // }
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
        $get = Answer::where('id', $id)->first();
        $question = Question::where('id', $get->question_id)->first();
        $answer = $question->answer;  
        $question->answer = $answer-1;
        $question->save(); 
        $delete=new Answer();
        $delete->where('id', '=', $id)->delete();
        // $deleye = Question::all();
        return back();
    }
}

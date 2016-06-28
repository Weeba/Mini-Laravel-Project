<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
Use Auth;
Use App\Question;
Use App\Answer;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('question.question');
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
            'body' => 'required|max:255|min:10',
            'category_id' => 'required',
        ]);
        $body = strip_tags($request->body);
        // return $request->category_id;
        $question = new Question([
            'body' => $body,
            'category_id' => $request->category_id,   
            'user_id' => $user->id,
        ]);
        $question->save();
        $question = Question::all();
        return redirect()->action('HomeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        // return $id;
        // $id = 5;
        // $questions = Question::all()->where('id', $id);
        $questions =  Question::where('id', $id)->with('answers')->get();
        $users = User::with('pictures')->get();
        $answers = Answer::where('question_id', $id)->orderBy('created_at', 'asc')->get();
        // return $answers;
        // return $questions;
        // $questions = Question::where('id', $id)->get();
        return view('question.show', compact('questions', 'users', 'answers'));
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
        $delete=new Question();
        $delete->where('id', '=', $id)->delete();
        // $deleye = Question::all();
        return back();
    }
}

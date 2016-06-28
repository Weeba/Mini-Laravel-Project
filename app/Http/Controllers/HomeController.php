<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
// use Illuminate\Pagination\Paginator;
use Auth;
use App\Question;
use App\User;
use App\Category;
use App\QuestionVote;
use App\Picture;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('pictures')->get();
        $questions = Question::orderBy('created_at', 'desc')->simplePaginate(10);
        $auth = Auth::user();
        $currUser = User::where('id', Auth::user()->id)->first();

        if(Picture::where('user_id', $currUser->id)->count()==0){
             $picture = new Picture([
                    'user_id' => Auth::user()->id,
                ]);
            $picture->save();
        }

        $today = Carbon::now()->format('Y-m-d').'%';
        $trendings = Question::where('created_at', 'like', $today)->orderBy('answer', 'desc')->take(10)->get();
        // $i=0;
        $categories=  Category::with('questions')->get();    

        return view('home', compact('questions', 'categories', 'users', 'trendings', 'auth'));
    }
    public function category(Request $request){

        $auth = Auth::user();
        $today = Carbon::now()->format('Y-m-d').'%';
        $trendings = Question::where('created_at', 'like', $today)->orderBy('answer', 'desc')->take(10)->get();
        $users = User::with('pictures')->get();
        $questions = Question::where('category_id', $request->category)->orderBy('created_at', 'desc')->simplePaginate(10);
        $categories =  Category::with('questions')->get();   
        
        return view('home', compact('questions', 'categories', 'users', 'trendings'));
    }
}

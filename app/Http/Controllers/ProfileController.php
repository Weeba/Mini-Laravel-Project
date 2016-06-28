<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Question;
use App\Category;
use App\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =  User::where('id', Auth::user()->id)->with('questions')->get();
        $picture = User::where('id', Auth::user()->id)->with('pictures')->get();
        $file = "/images/profile/".$users->first()->pictures->filename.$users->first()->pictures->extension;
        // return $file;
        $category = Category::all();
        // return $user;
        // return $user->questions; 
        return view('profile.profile', compact('users', 'category', 'file'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users =  User::where('id', $id)->with('questions')->get();
        $category = Category::all();
        $picture = User::where('id', $id)->with('pictures')->get();
        $file = "/images/profile/".$users->first()->pictures->filename.$users->first()->pictures->extension;
        // return $user;
        // return $user->questions; 
        return view('profile.profile', compact('users', 'category', 'file'));
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

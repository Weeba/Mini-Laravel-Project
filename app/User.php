<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
Use App\Question;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function question_votes()
    {
        return $this->hasMany(QuestionVote::class);
    }
    public function answer_votes()
    {
        return $this->hasMany(AnswerVote::class);
    }
    public function pictures()
    {
        return $this->hasOne(Picture::class);
    }
}

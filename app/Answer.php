<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable =  ['body', 'question_id', 'user_id', 'upvote'];
    public function questions()
    {
        return $this->belongsTo(Question::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function answer_votes()
    {
        return $this->hasMany(AnswersVote::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerVote extends Model
{
    protected $fillable =  ['answer_id', 'user_id'];
    protected $table = 'answer_votes';
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}

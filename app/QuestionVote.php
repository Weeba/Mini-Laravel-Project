<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionVote extends Model
{
    protected $fillable =  ['question_id', 'user_id'];
    protected $table = 'question_votes';
    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}

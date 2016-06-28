<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Question extends Model
{
    protected $fillable =  ['body', 'category_id', 'user_id', 'upvote'];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function question_votes()
    {
        return $this->hasMany(QuestionVote::class);
    }
}

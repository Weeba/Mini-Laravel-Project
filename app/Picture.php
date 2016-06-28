<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'pictures';
    protected $fillable = ['user_id'];
    public function users()
    {
            return $this->belogsTo(User::class);
    }
}

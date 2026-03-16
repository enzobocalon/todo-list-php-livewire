<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title', 'content', 'user_id', 'completed_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

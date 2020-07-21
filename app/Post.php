<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'user_id', 'created_by', 'created_at',
    ];

    protected $table = "posts";

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}

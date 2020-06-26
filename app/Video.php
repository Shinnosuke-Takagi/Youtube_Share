<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $visible = [
      'video_id', 'recommender',
    ];

    protected $perPage = 30;

    public function recommender()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }
}

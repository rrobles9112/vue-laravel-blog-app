<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    function user()
    {
        return $this->belongsTo('App\Posts');
    }

}

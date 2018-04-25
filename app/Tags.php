<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    //

    public function comments()
    {
        return $this->morphMany('App\Taggables', 'taggables');
    }

}

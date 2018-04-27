<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    //

    protected $table = 'tags';
    protected $fillable = ['name'];

    public function comments()
    {
        return $this->morphMany('App\Taggables', 'taggables');
    }

}

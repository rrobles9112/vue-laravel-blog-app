<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taggables extends Model
{
    //

    public function taggables()
    {
        return $this->morphTo();
    }

}

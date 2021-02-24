<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $primaryKey = 'uid';

    public function categories(){
        return $this->belongsTo('App\Category');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['name', 'description'];

    // Applications belong to a user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Applications can have multiple answers
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }
}

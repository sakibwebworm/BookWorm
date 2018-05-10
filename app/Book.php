<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'user_id', 'identifier', 'picture',
    ];
    /*A book belongs to a user*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

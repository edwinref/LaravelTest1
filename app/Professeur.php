<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\support\Facades\Auth;


class Professeur extends Model
{
    public function scopeProfs($query)
    {
        if (Auth::user()->role_id == 2)
        {
            return $query->where('user_id', '=', Auth::user()->id);
        }
        
    }
}

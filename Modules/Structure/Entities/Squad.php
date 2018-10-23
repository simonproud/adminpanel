<?php

namespace Modules\Structure\Entities;

use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'squads_users', 'squad_id', 'user_id');
    }
}
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

	
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	
    protected $fillable = [
       'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function mailserverAuth(){
        return $this->hasOne('Modules\Mailbox\Entities\MailserverAuth');
    }

	public function myFields()
    {
		$instance = $this->hasMany('App\UserInfo');
		$instance->where('user_id','=', Auth::user()->id);
        return $instance;
    }
	 public function fields()
    {
        return $this->hasMany('App\UserInfo');
    }

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
	 
}

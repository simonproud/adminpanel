<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
	 protected $table = 'users_info';
	public $timestamps = true;
	const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}

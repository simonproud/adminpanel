<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 03.09.18
 * Time: 16:05
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\UserInfo;
use Auth;

class UserDataComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
       if(Auth::check()){
        $list = [];
       $listAr = UserInfo::where('user_id', Auth::user()->id)->get();
       foreach ($listAr as $key=>$item){
           $view->with('USER_'.$item->key, $item->value);
          // $list[$item->key] = $item->value;
       }
       }

    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\UserInfo;

class PersonalInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user()->id;

        $userInfo = UserInfo::where('user_id', $user)->get();
        if(count($userInfo) < 2) {
            return redirect(route('personal.edit'));
        }else{
            $info = [];
            foreach ($userInfo as $k=>$i){
                $info[$i->key] = $i->value;
            }
            $cookie = serialize($userInfo);
            $request->session()->put('userinfo', $info);
        }
        return $next($request);
    }
}

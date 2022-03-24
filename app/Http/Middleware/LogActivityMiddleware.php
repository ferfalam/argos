<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LogActivityMiddleware
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
        $user = auth()->user();
        if (Auth::check()) {
            $expireAt = Carbon::now()->addMinutes(1);
            Cache::store('file')->put('online-user-'.$user->id, $user->id, $expireAt);
        }
        // $onlineUsers = Cache::store('file')->get('online-users');
        // if ($onlineUsers != null) {
        //     $onlineUsers = array_push($onlineUsers, $user);
        // }else{
        //     $onlineUsers = array($user);
        // }
        // Cache::store('file')->put('online-users', $onlineUsers);
        return $next($request);
    }
}

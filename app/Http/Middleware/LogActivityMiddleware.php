<?php

namespace App\Http\Middleware;

use App\LoginHistory;
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
            $expireAt = Carbon::now()->addMinutes(30);
            $current_his = LoginHistory::where("user_id", $user->id)->where("login_at", $user->last_login)->orderBy("created_at", "DESC")->first();
            if ($current_his) {
                $date = Carbon::parse($user->last_login);
                $now = Carbon::now();
                $user->last_login_duration = $date->diffInSeconds($now);
                $user->save();
                $current_his->duration = $user->last_login_duration;
                $current_his->save();
            }else{
                $user->last_login = Carbon::now();
                $user->save();
                $history = new LoginHistory();
                $history->user_id = $user->id;
                $history->company_id = $user->company->id;
                $history->login_at = Carbon::parse($user->last_login)->format('Y-m-d H:i:s');
                $history->duration = "--";
                $history->save();
            }
            Cache::store('file')->put('online-user-'.$user->id, $user->id, $expireAt);
        }
        return $next($request);
    }
}

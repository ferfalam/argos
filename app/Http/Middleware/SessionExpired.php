<?php
namespace App\Http\Middleware;

use App\LoginHistory;
use Closure;
use Illuminate\Session\Store;
use Auth;
use Carbon\Carbon;
use Session;

class SessionExpired
{
    protected $session;
    protected $timeout = 1800;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }
    public function handle($request, Closure $next)
    {
        $isLoggedIn = !$request->routeIs('logout');
        if (!session('lastActivityTime'))
            $this->session->put('lastActivityTime', time());
        elseif (time() - $this->session->get('lastActivityTime') > $this->timeout) {
            $this->session->forget('lastActivityTime');
            $cookie = cookie('intend', $isLoggedIn ? url()->current() : '/login');
            $user = auth()->user();
            $user->online = false;
            $date = Carbon::parse($user->last_login);
            $now = Carbon::now();
            $user->last_login_duration = $date->diffInSeconds($now);
            $user->save();
            $history = LoginHistory::where("user_id", $user->id)->where("login_at", $user->last_login)->orderBy("created_at", "DESC")->first();
            $history->duration = $user->last_login_duration;
            $history->save();
            auth()->logout();
        }
        $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        return $next($request);
    }
}
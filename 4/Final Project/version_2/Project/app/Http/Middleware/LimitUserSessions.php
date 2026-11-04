<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LimitUserSessions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $activeSessions = DB::table('sessions')
                ->where('user_id', $user->id)
                ->orderBy('last_activity', 'desc')
                ->get();

            if ($activeSessions->count() > 2) {
                // حذف sessionهای قدیمی‌تر
                $sessionsToRemove = $activeSessions->slice(2); // فقط ۲ تای اول رو نگه دار
                foreach ($sessionsToRemove as $session) {
                    DB::table('sessions')->where('id', $session->id)->delete();
                }
            }
        }

        return $next($request);
    }
}

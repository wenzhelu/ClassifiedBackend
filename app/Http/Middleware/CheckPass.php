<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use App\User;

class CheckPass
{
    /**
     * Handle an incoming request.
     * Check the token in the header
     * Use the integer role to control the 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  integer role 
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // login request don't need to authorize  
        $auth = $request->header('Auth');
        if (is_null($auth) || empty($auth)) {
            return response('', 401);   // unauthorized
        }

        $auth = base64_decode($auth);
        Log::debug("Authorization header: $auth");

        // parse id and check password and role
        $pos = strpos($auth, ':');
        if ($pos === FALSE) return response('', 400);
        $id = (integer) substr($auth, 0, $pos);

        Log::debug("Finding user: $id");

        $user = User::find($id);

        if (is_null($user)) return response('user not found', 400);

        if ($user->token !== substr($auth, $pos + 1) || time() - strtotime($user->token_time) > 1200) {
            // token incorrect or expired
            // token expired in 600 seconds
            return response('token incorrect or expired', 401);
        }

        if ($user->role > $role) return response('previlege not granted', 401);
        
        return $next($request);
    }
}

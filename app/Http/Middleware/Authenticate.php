<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if ($request->bearerToken()) {
            $user = User::where('api_token', $request->bearerToken())->with(['userroles.roles', 'userroles.roles.rolectrl', 'userroles.roles.rolectrl.ctrls',])->first();
            if ($user->is_admin == 1)
                return $next($request);
            if (isset($user->userroles[0]->roles->rolectrl))
                foreach ($user->userroles[0]->roles->rolectrl as $val) {
                    if (str_contains($request->path(), strtolower($val->ctrls->name))) {
                        return $next($request);
                    }
                }
            return response('Unauthorized.', 200);
        } else {
            return response('Unauthorized.', 200);
        }
    }
}

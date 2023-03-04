<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class IsAccountLogin {
    /**
     * The authentication factory instance.
     */
    protected Auth $_auth;

    /**
     * Create a new middleware instance.
     */
    public function __construct(Auth $auth) {
        $this->_auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards) {
        $this->authenticate($guards);

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     */
    protected function authenticate(array $guards) {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->_auth->guard($guard)->check()) {
                $this->_auth->shouldUse($guard);
                return;
            }
        }

        abort(401);
    }
}

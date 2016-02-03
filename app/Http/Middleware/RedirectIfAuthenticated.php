<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\User;

class RedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();

        if ($this->auth->check() && $user->status==3) {
            return redirect('/home');
        }
        if ($this->auth->check() && $user->status==1) {
            return redirect('/mhs/beranda');
        }

        if ($this->auth->check() && $user->status==0) {
            $this->auth->logout();
            return redirect('auth/login')->withErrors(['notactive' => 'user tidak aktif']);
        }

        return $next($request);
    }
}

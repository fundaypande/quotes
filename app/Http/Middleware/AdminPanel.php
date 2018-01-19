<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminPanel
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
      if ((Auth::user() -> access) != 'admin') {
          return redirect('/profile')->with('msg-warning', 'Anda Tidak Bisa Mengakses Halaman Admin');
      }
        return $next($request);
    }
}

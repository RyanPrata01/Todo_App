<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class isGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //cek kalau di auth nya udah ada history login, dia nggak boleh masuk ke login lagi bakal di redirect balik ke todo
        if(Auth::check()){
            return redirect()->route('todo.index')->with('notAllowed', 'Anda sudah login');    
        }
        //Kalau gaada history login, baru boleh next ke login 
        return $next($request);

    }
}

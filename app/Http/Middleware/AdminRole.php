<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
           $level = Auth::user()->level;
           switch ($level) {
               case 0:
                  return $next($request);
               case 1:
                  return redirect('admin/welcome');
               default:
                  return redirect('home');
           }
              
        }
        else {
         return redirect('/');
     }
    }
}

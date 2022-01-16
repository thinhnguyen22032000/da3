<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class StudentRole
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
               case 2:
                  return $next($request);
               case 0:
                  return redirect('admin/dashboard');
               default:
                  return redirect('admin/welcome');
           }
              
        }
        else {
         return redirect('/');
     }
    }
}

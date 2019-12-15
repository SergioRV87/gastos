<?php

namespace App\Http\Middleware;

use Closure;

class esAdmin
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
        if(\Session::exists('usuario'))
        {
            $usr=new Usuario("", "", "", "","","");
            $usr=\Session::get('usuario');
            $tus= $usr->getRol();
            if($tus=="administrador"){
                return $next($request);
            }else{
                abort(520);
            }
        }
        else 
        {
            abort(518);
        }
    }
}

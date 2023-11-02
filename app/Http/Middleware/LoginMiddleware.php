<?php
namespace App\Http\Middleware;

use closure;

class LoginMiddleware {
    public function handle($request, Closure $next){
        if(!($request->input('username') == 'aku' && $request->input('password')=='kamu')){
            return 'kata sandi atau username tidak valid';
        }
        return $next($request);
    }
}
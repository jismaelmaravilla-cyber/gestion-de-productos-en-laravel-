<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificarRol
{
    
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        
        if (!Auth::check()) {
            return redirect()->route('login');
        }

      
        $usuario = Auth::user();

       
        if (!in_array($usuario->rol, $roles, true)) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        
        return $next($request);
    }
}

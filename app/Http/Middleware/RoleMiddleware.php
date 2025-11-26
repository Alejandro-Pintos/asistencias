<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  array<int, string>  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        if (! in_array($userRole, $roles, true)) {
            // Redirigir al dashboard correcto según el rol del usuario
            return match ($userRole) {
                'admin'   => redirect()->route('admin.dashboard'),
                'teacher' => redirect()->route('profesor.dashboard'),
                'student' => redirect()->route('alumno.dashboard'),
                default   => redirect()->route('login'),
            };
        }

        return $next($request);
    }
}

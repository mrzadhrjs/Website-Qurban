<?php

namespace App\Http\Middleware;
use App\Models\Keranjang;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Pembayaran
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if (!$user) {
            return redirect('/');
        }
        
        $keranjang = Keranjang::where('user_id', $user->id)->first();

    if ($keranjang === null) {
        
        return redirect('/');
    }

        return $next($request);
    }
}

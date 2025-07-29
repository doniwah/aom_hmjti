<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;

class ValidateBarcode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $barcode = $request->input('barcode');
        $order = Order::where('barcode', $barcode)->first();

        if (!$order || $order->barcode_used) {
            return redirect()->route('invalid-barcode');
        }

        $order->update(['barcode_used' => true]);

        return $next($request);
    }
}
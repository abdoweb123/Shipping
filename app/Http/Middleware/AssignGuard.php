<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Traits\CheckApi;
use Closure;
use Illuminate\Http\Request;

class AssignGuard
{

    use CheckApi;

    public function handle(Request $request, Closure $next, $guard = null)
    {

        if ($guard != null)
        {
            auth()->shouldUse($guard);

            try {
                auth()->authenticate();
            }
            catch (\Exception $exception){

                return $this->returnMessageError('غير مصرح لك بالدخول','500');
            }
        }


        return $next($request);
    }
}

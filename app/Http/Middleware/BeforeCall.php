<?php

namespace App\Http\Middleware;

use Closure;

class BeforeCall
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

        $token = "Jll7q0BSijLOrzaOSm5Dr5hW9cJRZAJKOzvDlxjKCXepwAeZ7JR6YP5zQqnw";

        if( isset($request->_token)){
            if ($request->_token == $token ) {
                return $next($request);        
            }
        }

        return response(array("msg"=>"Token is't matched"));
    }
}

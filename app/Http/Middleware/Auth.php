<?php

namespace App\Http\Middleware;

use Closure;

@session_start();

class Auth
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


        if(isset($_SESSION['id'])&&isset($_SESSION['token'])){
            #allow
            return $next($request); 
        }else{
            $script='<script type="text/javascript">setTimeout(function(){window.location="/laravel/public/authentication";},600)</script>';

            echo $script;
        }

        #stop all script execution
        exit;
    }
}

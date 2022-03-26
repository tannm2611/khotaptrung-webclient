<?php

namespace App\Http\Middleware;

use App\Library\DirectAPI;
use Cache;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;
use function Illuminate\Events\queueable;

class VerifyShop extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle(Request $request, Closure $next)
    {

        $data = Cache::rememberForever('verify_shop', function()  {
            $url = '/very-shop';
            $method = "POST";
            $data = DirectAPI::_makeRequest($url,[],$method);

            return $data;
        });

        if(isset($data) &&$data->httpcode === 200 && $data->data->status == 1){

            return $next($request);

        }

        return response('Shop không có quyền truy cập!');


    }
}

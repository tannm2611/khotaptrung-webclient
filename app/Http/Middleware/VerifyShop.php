<?php

namespace App\Http\Middleware;

use App\Library\DirectAPI;
use Cache;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
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

//    public function handle( $request, Closure $next)
//    {
//
//        $verify_shop = Cache::rememberForever('verify_shop', function()  {
//            $url = '/very-shop';
//            $method = "POST";
//            $data = DirectAPI::_makeRequest($url,[],$method);
//
//            if(isset($data) &&$data->response_code === 200 && $data->response_data->status == 1){
//                return true;
//            }
//            return false;
//
////            return $data;
//        });
//        if($verify_shop === true){
//            return $next($request);
//        }
//
//        return response('Shop không có quyền truy cập!');
//
//
//    }

    public function handle( $request, Closure $next)
    {

        $data = Cache::rememberForever('verify_shop', function()  {
            $url = '/very-shop';
            $method = "POST";
            $data = DirectAPI::_makeRequest($url,[],$method);


            return $data;
        });

        $myfile = fopen(storage_path() ."/logs/CACHE-".Carbon::now()->format('Y-m-d').".txt", "a") or die("Unable to open file!");
        $txt = Carbon::now()." : [DATA: ".json_encode($data,JSON_UNESCAPED_UNICODE)."]";
        fwrite($myfile, $txt ."\n");
        fclose($myfile);

        if(isset($data) &&$data->response_code === 200 && $data->response_data->status == 1){

            return $next($request);

        }

        return response('Shop không có quyền truy cập!');


    }
}

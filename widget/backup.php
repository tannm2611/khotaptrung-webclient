<?php


use App\Library\DirectAPI;
use Illuminate\Pagination\LengthAwarePaginator;
use function PHPUnit\Framework\isEmpty;

View::composer('frontend..widget.__slider__banner', function ($view) {

    $url_slider = '/get-slider-banner';
    $method_slider = "GET";
    $val_slider = array();

    $result_Api_slider = DirectAPI::_makeRequest($url_slider,$val_slider,$method_slider);
    $result_slider = $result_Api_slider->data;
    $data_slider = $result_slider->data;

    return $view->with('data_slider', $data_slider);
});

View::composer('frontend.widget.__content__home', function ($view) {

    $url = '/acc';
    $method = "GET";
    $val = array();
    $val['data'] = 'category_list';
    $val['module'] = 'acc_category';

    $result_Api = DirectAPI::_makeRequest($url,$val,$method);
    if(isset($result_Api) && $result_Api->httpcode == 200){
        $data = $result_Api->data;
    }else{
        return 'sai';
    }

    $param['secret_key'] = config('api.secret_key');
    $param['domain'] = \Request::server("HTTP_HOST");
    $url = '/minigame/get-list-minigame';
    $group_api = DirectAPI::_makeRequest($url,$param,$method);
    if(isset($group_api) && $group_api->httpcode == 200){
        $dataGame = $group_api->data;
    }else{

    }

    return $view->with('data', $data)->with('dataGame', $dataGame);
});


View::composer('frontend.widget.__menu_category_desktop', function ($view) {

    $url_menu_category = '/menu-category';
    $method_menu_category  = "POST";
    $val_menu_category  = array();
    $result_Api_menu_category  = DirectAPI::_makeRequest($url_menu_category ,$val_menu_category ,$method_menu_category );
    $result_menu_category = $result_Api_menu_category->data;
    $data_menu_category  = $result_menu_category->data;

    return $view->with('data_menu_category', $data_menu_category);

});

View::composer('frontend.widget.__menu_category_mobile', function ($view) {

    $url_menu_category = '/menu-category';
    $method_menu_category  = "POST";
    $val_menu_category  = array();
    $result_Api_menu_category  = DirectAPI::_makeRequest($url_menu_category ,$val_menu_category ,$method_menu_category );
    $result_menu_category = $result_Api_menu_category->data;
    $data_menu_category  = $result_menu_category->data;

    return $view->with('data_menu_category', $data_menu_category);


});

View::composer('frontend.widget.__menu_profile', function ($view) {

    $url_menu_profile = '/menu-profile';
    $method_menu_profile = "POST";
    $val_menu_profile = array();
    $result_Api_menu_profile = DirectAPI::_makeRequest($url_menu_profile ,$val_menu_profile ,$method_menu_profile );
    $result_menu_profile = $result_Api_menu_profile->data;
    $data_menu_profile = $result_menu_profile->data;

    return $view->with('data_menu_profile', $data_menu_profile);

});

View::composer('frontend.widget.__menu_transaction', function ($view) {

    $url_menu_transaction = '/menu-transaction';
    $method_menu_transaction = "POST";
    $val_menu_transaction = array();
    $result_Api_menu_transaction = DirectAPI::_makeRequest($url_menu_transaction ,$val_menu_transaction ,$method_menu_transaction);
    $result_menu_transaction = $result_Api_menu_transaction->data;
    $data_menu_transaction= $result_menu_transaction->data;

    return $view->with('data_menu_transaction', $data_menu_transaction);
});

View::composer('frontend.widget.__menu__category__article', function ($view) {

    $url = '/article';
    $method = "GET";
    $val = array();

    $result_Api = DirectAPI::_makeRequest($url,$val,$method);

    $result = $result_Api->data;
    $datacategory = $result->datacategory;
    $count = $result->count;
    return $view->with('datacategory', $datacategory)->with('count', $count);
});

View::composer('frontend.widget.__top_nap_the', function ($view) {
    return $view;
});

View::composer('frontend.widget.__nap_the', function ($view) {
    return $view;
});

//View::composer('frontend.widget.__charge', function ($view) {
////    if($request->hasCookie('jwt')){
////    dd($request->cookie('jwt'));
////        try{
//            dd(111);
//            $url = '/deposit-auto/get-telecom';
//            $method = "GET";
//            $item = array();
//            $item['token'] = 'dsdsd';
//            $item['secret_key'] = config('api.secret_key');
//            $item['domain'] = 'youtube.com';
//
//            $result_Api = DirectAPI::_makeRequest($url,$item,$method);
//
//            if (isset($result_Api) && $result_Api->httpcode == 200 ) {
//                $result = $result_Api->data;
//
//                if ($result->status == 1) {
//                    return view('frontend.pages.index', compact('result'));
//                }
//                else {
//                    return redirect()->back()->withErrors($result->message);
//
//                }
//            } else {
//                return 'sai';
//            }
//
//        }
//        catch(\Exception $e){
//
//            Log::error($e);
//            return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
//        }
//
////    }
////    else{
////        return redirect('login');
////    }
//});





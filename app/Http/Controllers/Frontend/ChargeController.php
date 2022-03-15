<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\DirectAPI;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ChargeController extends Controller

{
    public function getDepositAuto(Request $request)
    {
        if($request->hasCookie('jwt')){
            try{
                $urlhistory = '/deposit-auto/history';


                $url = '/deposit-auto/get-telecom';
                $method = "GET";
                $data = array();
                $data['token'] = $request->cookie('jwt');
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = 'youtube.com';

                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                $result_ApiHistory = DirectAPI::_makeRequest($urlhistory,$data,$method);

                    if (isset($result_Api) && $result_Api->httpcode == 200 && isset($result_ApiHistory)== 200 && $result_ApiHistory->httpcode == 200) {
                        $bank = $result_Api->data;
                        $bankHistory = $result_ApiHistory->data;

                        if ($bank->status == 1) {
                            try{
                                $url = '/deposit-auto/get-amount';
                                $method = "GET";
                                $data = array();
                                $data['token'] =  $request->cookie('jwt');
                                $data['secret_key'] = config('api.secret_key');
                                $data['domain'] = 'youtube.com';
                                $data['telecom'] = $bank->data[0]->key;
                                $result_Api = DirectAPI::_makeRequest($url,$data,$method);

                                if(isset($result_Api) && $result_Api->httpcode == 200){
                                    $amount = $result_Api->data;
                                    if($amount->status == 1){
                                        return view('frontend.pages.account.user.pay_card', compact('bank','amount','bankHistory'));
//                    return view('frontend.pages.account.user.transaction_history')->with('result',$result);
                                    }
                                    else{
                                        return redirect()->back()->withErrors($amount->message);

                                    }
                                }else{
                                    return 'sai';
                                }
                            }
                            catch(\Exception $e){
                                Log::error($e);
                                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
                            }

                        } else {
                            return redirect()->back()->withErrors($bank->message);

                        }
                    } else {
                        return 'sai';
                    }
            }
            catch(\Exception $e){
                Log::error($e);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }

        }
        else{
            return redirect('login');
        }


    }



    public function getTelecomDepositAuto(Request $request)
    {

//        \Validator::

        if($request->hasCookie('jwt')){
            try{
                $url = '/deposit-auto/get-amount';
                $method = "GET";
                $data = array();
                $data['token'] =  $request->cookie('jwt');
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = 'youtube.com';
                $data['telecom'] = $request->telecom;
                $result_Api = DirectAPI::_makeRequest($url,$data,$method);

                if(isset($result_Api) && $result_Api->httpcode == 200){
                    $result = $result_Api->data;
                    if($result->status == 1){
                        return response()->json([
                            'status' => 1,
                            'data' => $result
                        ]);
//                    return view('frontend.pages.account.user.transaction_history')->with('result',$result);
                    }
                    else{
                        return redirect()->back()->withErrors($result->message);

                    }
                }else{
                    return 'sai';
                }
            }
            catch(\Exception $e){
                Log::error($e);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }

        }


    }
    public function postTelecomDepositAuto(Request $request)
    {
        $validator = $this->validate($request,[
            'captcha' => 'required|captcha'
        ],[
            'captcha.required' => "Nhập mã capcha",
            'captcha.captcha' =>"Sai mã capcha",
        ]);

        if($request->hasCookie('jwt')){
            try{
                $url = '/deposit-auto';
                $method = "POST";
                $data = array();
                $data['token'] =  $request->cookie('jwt');
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = 'youtube.com';
                $data['type'] = $request->telecom;
                $data['amount'] = $request->amount;
                $data['pin'] = $request->pin;
                $data['serial'] = $request->serial;

                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                if(isset($result_Api) && $result_Api->httpcode == 200){
                    $result = $result_Api->data;
                    $chargePost = $result_Api->data;
                    $message = $chargePost->message;

                    if($result->status == 1){
//                        return response()->json([
//                            'status' => 1,
//                            'data' => $result
//                        ]);
                        return response()->json([
                            'status' => 1,
                            'message'=>$message,
                            'data' => $chargePost
                        ]);
//                    return view('frontend.pages.account.user.transaction_history')->with('result',$result);
                    }
                    else{
                        return redirect()->back()->withErrors($result->message);

                    }
                }else{
                    return Response()->json($result_Api->data->message);
                }
            }
            catch(\Exception $e){
                Log::error($e);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }

        }


    }
    public function getChargeDepositHistory(Request $request)
    {
        if($request->hasCookie('jwt')){
            try{
                $url = '/deposit-auto/history';
                $method = "GET";
                $data = array();
                $data['token'] = $request->cookie('jwt');
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = 'youtube.com';

                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                if(isset($result_Api) && $result_Api->httpcode == 200){
                    $result = $result_Api->data;
                    if($result->status == 1){

                        return view('frontend.pages.account.user.pay_card_history')->with('result',$result);
                    }
                    else{
                        return redirect()->back()->withErrors($result->message);

                    }
                }else{
                    return 'sai';
                }
            }
            catch(\Exception $e){
                Log::error($e);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }
        }

    }
    public function getDepositHistory(Request $request)
    {
        if($request->hasCookie('jwt')){
            try{
                $url = '/deposit-auto/history';
                $method = "GET";
                $data = array();
                $data['token'] = $request->cookie('jwt');
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = 'youtube.com';

                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                if(isset($result_Api) && $result_Api->httpcode == 200){
                    $result = $result_Api->data;
                    if($result->status == 1){

                        return view('frontend.pages.account.user.transaction_history')->with('result',$result);
                    }
                    else{
                        return redirect()->back()->withErrors($result->message);

                    }
                }else{
                    return 'sai';
                }
            }
            catch(\Exception $e){
                Log::error($e);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }
        }

    }


}

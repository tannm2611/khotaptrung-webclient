<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\DirectAPI;
use Illuminate\Http\Request;

class TranferController extends Controller
{
    //
    public function getBank(Request $request)
    {
        if($request->hasCookie('jwt')){
            try{
                $urlhistory = '/transfer/history';


                $url = '/transfer/get-bank';
                $method = "GET";
                $data = array();
                $data['token'] = $request->cookie('jwt');
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = 'youtube.com';

                $result_Api = DirectAPI::_makeRequest($url,$data,$method);
                $result_ApiHistory = DirectAPI::_makeRequest($urlhistory,$data,$method);

                if (isset($result_Api) && $result_Api->httpcode == 200 && isset($result_ApiHistory)== 200 && $result_ApiHistory->httpcode == 200) {
                    $tranferbank = $result_Api->data;
                    $tranferbankHistory = $result_ApiHistory->data;
//                    dd($tranferbank->data->where($tranferbank->title));
//                    dd($tranferbank);
//                    if ($tranferbank->status == 1) {

                        return view('frontend.pages.account.user.pay_atm', compact('tranferbank','tranferbankHistory'));
//                    }
//
//                    else {
//                        return redirect()->back()->withErrors($tranferbank->message);
//
//                    }
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
    public function postDepositBank(Request $request)
    {
        if ($request->ajax()){
            if($request->hasCookie('jwt')){
                try{

                    $url = '/transfer/get-bank';
                    $method = "GET";
                    $data = array();
                    $data['token'] = $request->cookie('jwt');
                    $data['secret_key'] = config('api.secret_key');
                    $data['domain'] = 'youtube.com';

                    $result_Api = DirectAPI::_makeRequest($url,$data,$method);

                    if (isset($result_Api) && $result_Api->httpcode == 200) {
                        $tranferbank = $result_Api->data;

                        $tranferbankApi= $tranferbank->data[$request->dataid];
                        return response()->json([
                            'status' => 1,
                            'data' => [
                                'infoTranfer'=>$tranferbankApi,
                                'moneyBank'=>$request->money_bank
                            ]
                        ]);
//                    }
//
//                    else {
//                        return redirect()->back()->withErrors($tranferbank->message);
//
//                    }
                    } else {
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
    public function postTranferBank(Request $request)
    {
        $validator = $this->validate($request,[
            'captcha' => 'required|captcha'
        ],[
            'captcha.required' => "Nhập mã capcha",
            'captcha.captcha' =>"Sai mã capcha",
        ]);
//
//        if ($validator->fails()) {
//            return Response()->json($validator->errors());
//        }
        if($request->hasCookie('jwt')){
            try{
                $url = '/transfer';
                $method = "POST";
                $data = array();
                $data['token'] = $request->cookie('jwt');
                $data['secret_key'] = config('api.secret_key');
                $data['domain'] = 'youtube.com';
                $data['bank_id'] = $request->id_bank;
                $data['amount'] = $request->tranfer_money;
                $result_Api = DirectAPI::_makeRequest($url,$data,$method);

                if (isset($result_Api) && $result_Api->httpcode == 200) {
                    $tranferbankPost = $result_Api->data;
                    $message = $tranferbankPost->message;
                    if ($tranferbankPost->status==0){
                        return Response()->json($tranferbankPost->message);
                    }else{
                        return response()->json([
                            'status' => 1,
                            'message'=>$message,
                            'data' => $tranferbankPost
                        ]);
                    }
                } else {
                    return Response()->json($result_Api->data->message);
                }
            }
            catch(\Exception $e){
                Log::error($e);
                return redirect()->back()->withErrors('Có lỗi phát sinh.Xin vui lòng thử lại !');
            }

        }


        }


}

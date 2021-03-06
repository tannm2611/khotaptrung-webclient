<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\AuthCustom;
use App\Library\Helpers;
use Illuminate\Http\Request;
use App\Library\DirectAPI;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isEmpty;
use Session;
use Validator;

class ChargeController extends Controller

{
    public function index() {
        return view('index');
    }
    public function capthcaFormValidate(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'captcha' => 'required|captcha'
        ]);
        dd('thanh cong');
    }

    public function reloadCaptcha()
    {

        Session::push('url_return.id_return','1');
        return response()->json(['captcha'=> captcha_img()]);
    }
    public function myCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }
    public function reloadCaptcha2()
    {
        return captcha_img('flat');
    }
    public function getDepositAuto(Request $request)
    {

        return view('frontend.pages.charge.index');

    }

    public function getDepositAutoData(Request $request){

        if ($request->ajax()) {

            $page = $request->page;

            $url = '/deposit-auto/history';

            $method = "GET";
            $sendData = array();
            $jwt = Session::get('jwt');
            if (empty($jwt)) {
                return response()->json([
                    'status' => "LOGIN"
                ]);
            }
            $sendData['token'] = $jwt;
            $sendData['page'] = $page;

            $result_Api = DirectAPI::_makeRequest($url, $sendData, $method);
            $response_data = $result_Api->response_data??null;

            if(isset($response_data) && $response_data->status == 1){

                $data = $response_data->data;

                $arrpin = array();

                for ($i = 0; $i < count($data->data); $i++){
                    $pin = $data->data[$i]->pin;
                    $pin = Helpers::Decrypt($pin,config('module.charge.key_encrypt'));
                    array_push($arrpin,$pin);
                }

                $data = new LengthAwarePaginator($data->data, $data->total, $data->per_page, $page, $data->data);

                $html =  view('frontend.pages.charge.widget.__charge')
                    ->with('data', $data)->with('arrpin',$arrpin)->render();

                if (count($data) == 0 && $page == 1){
                    return response()->json([
                        'status' => 0,
                        'message' => 'Hi???n t???i kh??ng c?? d??? li???u n??o ph?? h???p v???i y??u c???u c???a b???n! H??? th???ng c???p nh???t nick th?????ng xuy??n b???n vui l??ng theo d??i web trong th???i gian t???i !',
                    ]);
                }

                return response()->json([
                    'status' => 1,
                    'data' => $html,
                    'message' => 'Load du lieu thanh cong.',
                ]);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message'=>$response_data->message??"Kh??ng th??? l???y d??? li???u"
                ]);
            }
        }
    }

    public function getTelecom(Request $request)
    {

        try{
            $url = '/deposit-auto/get-telecom';
            $method = "GET";
            $dataSend = array();
            $result_Api = DirectAPI::_makeRequest($url,$dataSend,$method);
             $data = $result_Api->response_data??null;
            if(isset($data) && $data->status == 1){
                return response()->json([
                    'status' => 1,
                    'message' => 'Th??nh c??ng',
                    'data' => $data->data,
                ],200);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message'=>$data->message??"Kh??ng th??? l???y d??? li???u"
                ]);
            }
        }
        catch(\Exception $e){
            Log::error($e);
            return response()->json([
                'status' => 0,
                'message' => 'C?? l???i ph??t sinh khi l???y nh?? m???ng n???p th???, vui l??ng li??n h??? QTV ????? x??? l??.',
            ]);
        }


    }

    public function getTelecomDepositAuto(Request $request)
    {
        try {
            $url = '/deposit-auto/get-amount';
            $method = "GET";
            $dataSend = array();
            $dataSend['telecom'] = $request->telecom;
            $result_Api = DirectAPI::_makeRequest($url,$dataSend,$method);
            $data = $result_Api->response_data??null;
            if(isset($data) && $data->status == 1){
                return response()->json([
                    'status' => 1,
                    'message' => 'Th??nh c??ng',
                    'data' => $data->data,
                ],200);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message'=>$data->message??"Kh??ng th??? l???y d??? li???u"
                ]);
            }
        }
        catch(\Exception $e){
            Log::error($e);
            return response()->json([
                'status' => 0,
                'message' => 'C?? l???i ph??t sinh khi l???y nh?? m???ng n???p th???, vui l??ng li??n h??? QTV ????? x??? l??.',
            ]);
        }

    }

    public function postTelecomDepositAuto(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'captcha' => 'required|captcha',
            'type' => 'required|regex:/^([A-Za-z0-9])+$/i',
            'amount' => 'required|integer|in:10000,20000,30000,50000,100000,200000,300000,500000,1000000,2000000,3000000,5000000',
            'pin' => 'required|between::9,22|regex:/^([A-Za-z0-9])+$/i',
            'serial' => 'required|between:9,22|regex:/^([A-Za-z0-9])+$/i',
        ],[
            'captcha.required' => "Nh???p m?? capcha",
            'captcha.captcha' => "Sai m?? capcha",
            'type.required' => __("Vui l??ng ch???n lo???i th???"),
            'type.regex' => __('Lo???i th??? kh??ng ???????c c?? k?? t??? ?????c bi???t'),
            'amount.required' => __("Vui l??ng ch???n m???nh gi??"),
            'amount.in' => __("M???nh gi?? kh??ng ????ng ?????nh d???ng"),
            'amount.integer' => __("M???nh gi?? kh??ng ????ng ?????nh d???ng"),
            'pin.required' => __("Vui l??ng nh???p m?? th???"),
            'pin.between' => __("M?? th??? ph???i t??? 9 - 16 k?? t???"),
            'pin.regex' => __('M?? th??? kh??ng ???????c c?? k?? t??? ?????c bi???t'),
            'serial.required' => __("Vui l??ng nh???p s??? serial"),
            'serial.between' => __("Serial th??? ph???i t??? 9 - 16 k?? t???"),
            'serial.regex' => __('Serial th??? kh??ng ???????c c?? k?? t??? ?????c bi???t'),
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()->first(),
                'status' => 0
            ]);
        }


        try {
            $url = '/deposit-auto';
            $method = "POST";
            $dataSend = array();
            $dataSend['token'] = session()->get('jwt');
            $dataSend['type'] = $request->type;
            $dataSend['amount'] = $request->amount;
            $dataSend['pin'] = $request->pin;
            $dataSend['serial'] = $request->serial;
            $result_Api = DirectAPI::_makeRequest($url, $dataSend, $method);
            $data = $result_Api->response_data??null;

            if(isset($data) && $data->status == 1){
                return response()->json([
                    'status' => 1,
                    'message' => $data->message,
                    'data' => $data,
                ],200);
            } elseif(isset($result_Api) && $result_Api->response_code == 401){
                return response()->json([
                    'status' => 401,
                    'message'=>"unauthencation"
                ]);
            }
            else{
                return response()->json([
                    'status' => 0,
                    'message'=>$data->message??"Kh??ng th??? l???y d??? li???u"
                ]);
            }
        }
        catch(\Exception $e){
            Log::error($e);
            return response()->json([
                'status' => 0,
                'message' => 'C?? l???i ph??t sinh khi l???y nh?? m???ng n???p th???, vui l??ng li??n h??? QTV ????? x??? l??.',
            ]);
        }

    }


    public function getChargeDepositHistory(Request $request)
    {
        if (AuthCustom::check()) {

            $method = "GET";

            if ($request->ajax()) {
                $page = $request->page;

                $url = '/deposit-auto/history';

                $val = array();
                $jwt = Session::get('jwt');
                if (empty($jwt)) {
                    return response()->json([
                        'status' => "LOGIN"
                    ]);
                }

                $val['token'] = $jwt;
                $val['page'] = $page;

                if ($request->filled('serial')) {
                    $val['serial'] = $request->serial;
                }

                if ($request->filled('key')) {
                    $val['key'] = $request->key;
                }

                if ($request->filled('key')) {
                    $val['status'] = $request->status;
                }

                if ($request->filled('started_at')) {
                    $started_at = \Carbon\Carbon::parse($request->started_at)->format('Y-m-d H:i:s');
                    $val['started_at'] = $started_at;
                }

                if ($request->filled('ended_at')) {
                    $ended_at = \Carbon\Carbon::parse($request->ended_at)->format('Y-m-d H:i:s');
                    $val['ended_at'] = $ended_at;
                }
                $result_Api = DirectAPI::_makeRequest($url, $val, $method);
                $response_data = $result_Api->response_data??null;

                if(isset($response_data) && $response_data->status == 1){

                    $data = $response_data->data;

                    $arrpin = array();
                    $arrserial = array();

                    for ($i = 0; $i < count($data->data); $i++){
                        $serial = $data->data[$i]->serial;
                        $serial = Helpers::Decrypt($serial,config('module.charge.key_encrypt'));
                        array_push($arrserial,$serial);
                    }

                    for ($i = 0; $i < count($data->data); $i++){
                        $pin = $data->data[$i]->pin;
                        $pin = Helpers::Decrypt($pin,config('module.charge.key_encrypt'));
                        array_push($arrpin,$pin);
                    }

                    if (isEmpty($data->data)) {
                        $data = new LengthAwarePaginator($data->data, $data->total, $data->per_page, $page, $data->data);
                        $data->setPath($request->url());
                    }

                    if (count($data) == 0 && $page == 1){
                        return response()->json([
                            'status' => 0,
                            'message' => 'Kh??ng c?? d??? li???u !',
                        ]);
                    }

                    if ($page > $data->lastPage()) {
                        return response()->json([
                            'status' => 404,
                            'message'=>'Trang n??y kh??ng t???n t???i',
                        ]);
                    }

                    $html =  view('frontend.pages.charge.widget.__charge_history')
                        ->with('data',$data)->with('arrpin',$arrpin)->with('arrserial',$arrserial)->render();

                    return response()->json([
                        'status' => 1,
                        'data' => $html,
                        'message' => 'Load du lieu thanh cong.',
                    ]);
                }
                else{
                    return response()->json([
                        'status' => 0,
                        'message'=>$response_data->message??"Kh??ng th??? l???y d??? li???u"
                    ]);
                }
            }

            $url_telecome = '/deposit-auto/get-telecom';

            $sendDatatele = array();

            $result_telecome_Api = DirectAPI::_makeRequest($url_telecome, $sendDatatele, $method);

            $response_tele_data = $result_telecome_Api->response_data??null;

            if(isset($response_tele_data) && $response_tele_data->status == 1){

                $data_telecome = $response_tele_data->data;

                return view('frontend.pages.charge.logs')->with('data_telecome', $data_telecome);

            }
            else{
                return response()->json([
                    'status' => 0,
                    'message'=>$response_data->message??"Kh??ng th??? l???y d??? li???u"
                ]);
            }
        }
    }

//    public function getDepositHistory(Request $request)
//    {
//        if (AuthCustom::check()) {
//            try {
//                $url = '/deposit-auto/history';
//                $method = "GET";
//                $data = array();
//                $jwt = Session::get('jwt');
//                if (empty($jwt)) {
//                    return response()->json([
//                        'status' => "LOGIN"
//                    ]);
//                }
//                $data['token'] = $jwt;
//
//                $result_Api = DirectAPI::_makeRequest($url, $data, $method);
//                if (isset($result_Api) && $result_Api->response_code == 200) {
//                    $result = $result_Api->response_data;
//                    if ($result->status == 1) {
//
//                        return view('frontend.pages.account.user.transaction_history')->with('result', $result);
//                    } else {
//                        return redirect()->back()->withErrors($result->message);
//
//                    }
//                } else {
//                    return redirect()->back()->withErrors('C?? l???i ph??t sinh.Xin vui l??ng th??? l???i !');
//                }
//            } catch (\Exception $e) {
//                Log::error($e);
//                return redirect()->back()->withErrors('C?? l???i ph??t sinh.Xin vui l??ng th??? l???i !');
//            }
//        }
//
//    }

}

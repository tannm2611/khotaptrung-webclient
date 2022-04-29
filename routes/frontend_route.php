<?php
use App\Http\Controllers\Frontend\AccController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\CaptchaServiceController;
use App\Http\Controllers\Frontend\ChargeController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Library\DirectAPI;
use App\Library\AuthCustom;
use Illuminate\Support\Facades\Cache;
use \Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function ()
{



});

Route::get('/session', function ()
{
    Session::flush();
    return redirect()->to('/');
});
Route::get('/test111', function ()
{
    return 1111;
})->middleware('throttle:5,1');

//if (isset(theme('')->theme_key)){
//    if (theme('')->theme_key == 'theme_1'){

Route::group(array('middleware' => ['theme']) , function (){
        Route::group(array('middleware' => ['verify_shop']) , function (){
            Route::get('/theme', function ()
            {
                return view('frontend.index');
            });
            Route::post('/user/account_info', [UserController::class , "getInfo"]);
            Route::get('/top-charge', [\App\Http\Controllers\Frontend\HomeController::class , 'getTopCharge'])->name('getTopCharge');
            Route::group(['middleware' => ['cacheResponse: 86400']], function (){
                Route::get('/', [HomeController::class , "index"]);

                Route::get('/mua-the', [\App\Http\Controllers\Frontend\StoreCardController::class , 'getStoreCard'])->name('getStoreCard');
                // lấy nhà mạng mua thẻ
                Route::get('/store-card/get-telecom', [\App\Http\Controllers\Frontend\StoreCardController::class , 'getTelecomStoreCard'])->name('getTelecomStoreCard');
                // lấy mệnh giá trong mua thẻ
                Route::get('/store-card/get-amount', [\App\Http\Controllers\Frontend\StoreCardController::class , 'getAmountStoreCard'])
                    ->name('getAmountStoreCard');
                // ROUTE cần auth load dữ liệu không cache

                Route::get('/get-tele-card', [\App\Http\Controllers\Frontend\ChargeController::class , 'getTelecom']);
                Route::get('/get-tele-card/data', [\App\Http\Controllers\Frontend\ChargeController::class , 'getDepositAutoData']);

                Route::get('/get-amount-tele-card', [\App\Http\Controllers\Frontend\ChargeController::class , 'getTelecomDepositAuto']);

                Route::get('/tin-tuc', [ArticleController::class , "index"]);
                Route::get('/tin-tuc/data', [ArticleController::class , "getData"]);
                Route::get('/tin-tuc/{slug}/data', [ArticleController::class , "getCategoryData"]);
                Route::get('/tin-tuc/{slug}', [ArticleController::class , "show"]);



                Route::get('/dich-vu', [ServiceController::class , "getShowService"]);
                Route::get('/dich-vu/data', [ServiceController::class , "getShowServiceData"]);
                Route::get('/dich-vu/{slug}', [ServiceController::class , "getShow"]);
                Route::get('/dich-vu/{slug}/data', [ServiceController::class , "getShowData"]);
                Route::get('/dich-vu/{slug}/modaldata', [ServiceController::class , "getShowModalData"]);

                Route::group(['middleware' => ['auth_custom']], function (){

                    Route::get('/nap-the', [\App\Http\Controllers\Frontend\ChargeController::class , 'getDepositAuto'])->name('getDepositAuto');
                    Route::group(['middleware' => ['doNotCacheResponse']], function (){
                        //profile
                        Route::get('/profile', [\App\Http\Controllers\Frontend\UserController::class , 'profile'])
                            ->name('index');

                        Route::get('/thong-tin', [\App\Http\Controllers\Frontend\UserController::class , 'getThongTin'])
                            ->name('getThongTin');

                        Route::get('/thong-tin', [\App\Http\Controllers\Frontend\UserController::class , 'info'])
                            ->name('index');
                        Route::post('/nap-the', [\App\Http\Controllers\Frontend\ChargeController::class , 'postTelecomDepositAuto'])->name('postTelecomDepositAuto');
                        // route post mua thẻ

                        //lịch sử nạp thẻ


                        Route::get('/lich-su-nap-the', [\App\Http\Controllers\Frontend\ChargeController::class , 'getChargeDepositHistory'])
                            ->name('getChargeDepositHistory');
                        Route::get('/lich-su-nap-the/data', [\App\Http\Controllers\Frontend\ChargeController::class , 'getChargeDepositHistoryData'])
                            ->name('getChargeDepositHistoryData');

                        Route::post('{slug_category}/{id}/databuy', [AccController::class , "postBuyAccount"]);

                        Route::get('/lich-su-mua-account', [\App\Http\Controllers\Frontend\AccController::class , 'getBuyAccountHistory'])
                            ->name('getBuyAccountHistory');
                        Route::get('/lich-su-mua-account/data', [\App\Http\Controllers\Frontend\AccController::class , 'getBuyAccountHistoryData'])
                            ->name('getBuyAccountHistoryData');
                        //dịch vụ
                        Route::get('/dich-vu-da-mua', [\App\Http\Controllers\Frontend\ServiceController::class , 'getBuyServiceHistory'])
                            ->name('getBuyServiceHistory');

                        Route::get('/dich-vu-da-mua-{id}', [\App\Http\Controllers\Frontend\ServiceController::class , 'getShowBuyServiceHistory'])
                            ->name('getShowBuyServiceHistory');

                        Route::get('/destroyservice', [\App\Http\Controllers\Frontend\ServiceController::class , 'getDeleteServiceData'])
                            ->name('getDeleteServiceData');

                        Route::get('/editservice', [\App\Http\Controllers\Frontend\ServiceController::class , 'getEditServiceData'])
                            ->name('getEditServiceData');

                        Route::post('/dich-vu-da-mua-{id}/destroy',[\App\Http\Controllers\Frontend\ServiceController::class , 'postDestroy'])
                            ->name('postDestroy');

                        Route::post('/dich-vu-da-mua-{id}/edit',[\App\Http\Controllers\Frontend\ServiceController::class , 'editDestroy'])
                            ->name('editDestroy');

                        Route::post('/dich-vu/{id}/purchase',[\App\Http\Controllers\Frontend\ServiceController::class , 'postPurchase'])
                            ->name('getBuyServiceHistoryData');

                        Route::get('/lich-su-giao-dich-tich-hop', [\App\Http\Controllers\Frontend\UserController::class , 'getTranTichHop']);

                        Route::get('/lich-su-nap-the-tich-hop', [\App\Http\Controllers\Frontend\UserController::class , 'getLichSuNapThe']);

                        Route::get('/lich-su-mua-the-tich-hop', [\App\Http\Controllers\Frontend\UserController::class , 'getLichSuMuaThe']);

                        Route::get('/lich-su-giao-dich', [\App\Http\Controllers\Frontend\UserController::class , 'getTran']);
                    });
                });
                // Route không cần Auth load dữ liệu không cache
                Route::group(['middleware' => ['doNotCacheResponse']], function (){
                    Route::post('/logout', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'logout'])->name('logout');

                    Route::get('/mua-acc', [AccController::class , "getShowDanhmucCategory"]);
                    Route::get('/{slug_category}/{slug}', [AccController::class , "getShowCategory"]);
                    Route::get('/{slug_category}/{id}/databuy', [AccController::class , "getShowCategoryData"]);


                });

                //        Route::get('/{slug_category}/{slug}/data',[AccController::class,"getShowCategoryData"]);
                Route::get('/rut-vat-pham', function ()
                {
                    return view('frontend.pages.account.user.rutvatpham');
                });

                Route::get('/quay-ngay', function ()
                {
                    return view('frontend.pages.item_spin');
                });

                Route::get('/choi-ngay', function ()
                {
                    return view('frontend.pages.item_play');
                });

                Route::get('/mua-ngay', function ()
                {
                    return view('frontend.pages.item_buy');
                });
                Route::get('/mua-ngay/chi-tiet', function ()
                {
                    return view('frontend.pages.item_buy_detail');
                });
                Route::get('/tai-khoan-da-mua', function ()
                {
                    return view('frontend.pages.account.user.account_buy');
                });
                Route::get('/tai-khoan-tra-gop', function ()
                {
                    return view('frontend.pages.account.user.account_installment');
                });
                Route::get('/lich-su-quay-thuong', function ()
                {
                    return view('frontend.pages.account.user.spin_history');
                });

                Route::get('/gieo-que', function ()
                {
                    return view('frontend.pages.account.user.gieoque');
                });
                //đăng nhập, đăng xuất, đăng ký
                Route::get('/login', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'login'])
                    ->name('login');
                Route::post('/login', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'postLogin']);
                Route::post('loginApi', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'loginApi'])
                    ->name('loginApi');

                Route::get('/register', [\App\Http\Controllers\Frontend\Auth\RegisterController::class , 'showFormRegister'])
                    ->name('register');
                Route::post('register', [\App\Http\Controllers\Frontend\Auth\RegisterController::class , 'register']);
                Route::get('/changepassword', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'changePassword'])
                    ->name('changePassword');
                Route::post('/changePasswordApi', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'changePasswordApi'])
                    ->name('changePasswordApi');
                //capcha
                Route::get('/reload-captcha', [CaptchaServiceController::class , 'reloadCaptcha']);

                Route::get('/show', function ()
                {
                    return view('frontend.pages.service.show');
                });

                Route::group(array(
                    'middleware' => ['auth']
                ) , function ()
                {

                    Route::post('/post-deposit', [\App\Http\Controllers\Frontend\ChargeController::class , 'postDeposit'])
                        ->name('postDeposit');
                    Route::get('/get-amount-card', [\App\Http\Controllers\Frontend\ChargeController::class , 'getAmountCharge'])
                        ->name('getAmountCharge');
                    //Nạp thẻ Atm
                    Route::get('/recharge-atm', [\App\Http\Controllers\Frontend\TranferController::class , 'getBank'])
                        ->name('getBank');


                    Route::get('/recharge-atm-bank', [\App\Http\Controllers\Frontend\TranferController::class , 'postDepositBank'])
                        ->name('postDepositBank');
                    Route::get('/get-bank', [\App\Http\Controllers\Frontend\TranferController::class , 'getBankTranfer']);
                    Route::post('/recharge-atm-api', [\App\Http\Controllers\Frontend\TranferController::class , 'postTranferBank'])
                        ->name('postTranferBank');


                });

                Route::group(['middleware' => ['doNotCacheResponse']], function ()
                {
                    //minigame
                    Route::post('/minigame-play', [\App\Http\Controllers\Frontend\MinigameController::class , 'postRoll'])
                        ->name('postRoll');
                    Route::post('/minigame-bonus', [\App\Http\Controllers\Frontend\MinigameController::class , 'postBonus'])
                        ->name('postBonus');
                    Route::get('/minigame-log-{id}', [\App\Http\Controllers\Frontend\MinigameController::class , 'getLog'])
                        ->name('getLog');
                    Route::get('/minigame-logacc-{id}', [\App\Http\Controllers\Frontend\MinigameController::class , 'getLogAcc'])
                        ->name('getLogAcc');
                    Route::get('/minigame-{slug}', [\App\Http\Controllers\Frontend\MinigameController::class , 'getIndex'])
                        ->name('getIndex');
                    Route::get('/withdrawitem-{game_type}', [\App\Http\Controllers\Frontend\MinigameController::class , 'getWithdrawItem'])
                        ->name('getWithdrawItem');
                    Route::post('/withdrawitem-{game_type}', [\App\Http\Controllers\Frontend\MinigameController::class , 'postWithdrawItem'])
                        ->name('postWithdrawItem');

                    Route::get('/loginfacebook', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'loginfacebook'])
                        ->name('loginfacebook');

                });

            });
            Route::post('/mua-the', [\App\Http\Controllers\Frontend\StoreCardController::class , 'postStoreCard'])->name('postStoreCard');

//    Route::group(['middleware' => ['auth_custom']], function (){
//        Route::group(['middleware' => ['cacheResponse:300']], function (){
//            Route::get('/nap-the', [\App\Http\Controllers\Frontend\ChargeController::class , 'getDepositAuto'])
//            ->name('getDepositAuto');
//        });
//    });
        });
});

//    }
//    elseif (theme('')->theme_key == 'theme_2'){
//        Route::group(array('middleware' => ['verify_shop']) , function (){
//            Route::group(['middleware' => ['cacheResponse:300']], function (){
//                Route::group(['middleware' => ['doNotCacheResponse']], function (){
//                    Route::post('/logout', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'logout'])->name('logout');
//
//
//                });
//                //đăng nhập, đăng xuất, đăng ký
//                Route::get('/login', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'login'])
//                    ->name('login');
//                Route::post('/login', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'postLogin']);
//                Route::post('loginApi', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'loginApi'])
//                    ->name('loginApi');
//                Route::get('/loginfacebook', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'loginfacebook'])
//                    ->name('loginfacebook');
//                Route::get('/register', [\App\Http\Controllers\Frontend\Auth\RegisterController::class , 'showFormRegister'])
//                    ->name('register');
//                Route::post('register', [\App\Http\Controllers\Frontend\Auth\RegisterController::class , 'register']);
//                Route::get('/changepassword', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'changePassword'])
//                    ->name('changePassword');
//                Route::post('/changePasswordApi', [\App\Http\Controllers\Frontend\Auth\LoginController::class , 'changePasswordApi'])
//                    ->name('changePasswordApi');
//
//
//
//                Route::get('/blog', [ArticleController::class , "index"]);
//                Route::get('/blog/data', [ArticleController::class , "getData"]);
//                Route::get('/blog/{slug}/data', [ArticleController::class , "getCategoryData"]);
//                Route::get('/blog/{slug}', [ArticleController::class , "show"]);
//
//                Route::get('/', function ()
//                {
//                    return view('frontend.theme_2.pages.index');
//                });
//                Route::get('/user/profile', function ()
//                {
//                    return view('frontend.theme_2.pages.user.profile');
//                });
////                Route::get('/blog', function ()
////                {
////                    return view('frontend.theme_2.pages.blog');
////                });
////                Route::get('/blog/single', function ()
////                {
////                    return view('frontend.theme_2.pages.blog_single');
////                });
//                Route::get('/nap-the', function ()
//                {
//                    return view('frontend.theme_2.pages.deposit');
//                });
//                Route::get('/mua-the', function ()
//                {
//                    return view('frontend.theme_2.pages.buy');
//                });
//                Route::get('/ho-tro', function ()
//                {
//                    return view('frontend.theme_2.pages.support');
//                });
//            });
//        });
//    }
//}





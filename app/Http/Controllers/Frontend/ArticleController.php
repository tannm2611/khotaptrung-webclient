<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\DirectAPI;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request){

        $url = '/article';
        $method = "GET";
        $val = array();
        $result_Api = DirectAPI::_makeRequest($url,$val,$method);

        if(isset($result_Api) && $result_Api->httpcode == 200){
            $result = $result_Api->data;
            $data = $result->data;
            $data = $data->data;

            $is_over = $result->is_over;
            $category = true;
            return view('frontend.pages.article.index')
                ->with('is_over',$is_over)
                ->with('category',$category);
        }else{
            return 'sai';
        }
    }

    public function getData(Request $request){

        if ($request->ajax()){
            $page = $request->page;
            $append = $request->append;

            $url = '/article';
            $method = "GET";
            $val = array();
            $val['page'] = $page;

            if (isset($request->querry) || $request->querry != '' || $request->querry != null){
                $val['querry'] = $request->querry;
            }

            if (isset($request->slug) || $request->slug != '' || $request->slug != null){

                $val['slug'] = $request->slug;
            }


            $result_Api = DirectAPI::_makeRequest($url,$val,$method);
            if(isset($result_Api) && $result_Api->httpcode == 200){
                $result = $result_Api->data;
                if ($result->is_over){
                    return response()->json([
                        'is_over'=>true
                    ]);
                }
                $data = $result->data;
                $data = $data->data;

                return response()->json([
                    'data' => $data,
                    'append' => $append,
                    'is_over'=>false
                ]);
            }else{
                return 'sai';
            }
        }
    }


    public function getCategoryData(Request $request,$slug){

        if ($request->ajax()){
            $page = $request->page;
            $append = $request->append;

            $url = '/article/'.$slug;
            $method = "GET";
            $val = array();
            $val['page'] = $page;

            if (isset($request->querry) || $request->querry != '' || $request->querry != null){
                $val['querry'] = $request->querry;
            }

            $result_Api = DirectAPI::_makeRequest($url,$val,$method);
            if(isset($result_Api) && $result_Api->httpcode == 200){
                $result = $result_Api->data;
                if ($result->is_over){
                    return response()->json([
                        'is_over'=>true
                    ]);
                }
                $data = $result->data;
                $data = $data->data;

                return response()->json([
                    'data' => $data,
                    'append' => $append,
                    'is_over'=>false
                ]);
            }else{
                return 'sai';
            }
        }
    }

    public function show(Request $request,$slug){

        $url = '/article/'.$slug;
        $method = "GET";
        $val = array();
        $result_Api = DirectAPI::_makeRequest($url,$val,$method);

        if(isset($result_Api) && $result_Api->httpcode == 200){
            $result = $result_Api->data;

            if ($result->item == 1){
                $data = $result->data;
                $dataitem = $result->dataitem;

//                return $data;
                return view('frontend.pages.article.show')
                    ->with('dataitem',$dataitem)
                    ->with('data',$data);
            }else{
                $result = $result_Api->data;
                $data = $result->data;
                $is_over = $result->is_over;

                $title = $result->categoryarticle;

                return view('frontend.pages.article.index')
                    ->with('is_over',$is_over)
                    ->with('title',$title)
                    ->with('slug',$slug);
            }

        }else{
            return 'sai';
        }
    }

    public function showArticleCategory(Request $request,$slug){
        $url = '/show-service-category';
        $method = "GET";
        $val = array();
        $val['slug'] = $slug;

        $result_Api = DirectAPI::_makeRequest($url,$val,$method);

        $result = $result_Api->data;

        if ($result->is_router == false){
            $data = $result->data;
            $categoryservice = $result->categoryservice;
            $categoryservice = $categoryservice->data;
            //return $data;

            return view('frontend.pages.service.show')
                ->with('categoryservice',$categoryservice)
                ->with('data',$data)
                ->with('slug',$slug);
        }


        $data = $result->categoryservice;

        return view('frontend.pages.service.show_service_category')
            ->with('slug',$slug)
            ->with('data',$data);
    }
}

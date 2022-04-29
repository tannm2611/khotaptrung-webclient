
<title>{{$data->title??setting('sys_title') }}</title>
<meta name="description" content="{{ strip_tags($data->description??setting('sys_description')) }}">

<meta name="keywords" content="{{setting('sys_keyword')}}">
<link rel="shortcut icon" href="{{config('api.url_media').setting('sys_favicon') }}" type="image/x-icon">



@if(isset($data->title))
    <meta property="og:title" content="{{$data->title}}">
@else
    <meta property="og:title" content="{{setting('sys_title')}}">
@endif
@if(isset($data->image))
    <meta property="og:image" content="https://media-tt.nick.vn/{{$data->image }}">
@elseif ( setting('sys_og_image') && setting('sys_og_image') != "")
    <meta property="og:image" content="{{config('api.url_media').setting('sys_og_image') }}">
@else
    <meta property="og:image" content="{{config('api.url_media').setting('sys_logo') }}">
@endif

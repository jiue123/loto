@extends('layouts.app')

@section('content')
<style>
    * {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        cursor: pointer;
    }
    body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre,
    form, fieldset, input, textarea, p, blockquote, th, td {
        padding: 0;
        margin: 0;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        word-wrap: break-word;
        word-break: break-all;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    fieldset, img {
        border: 0;
    }
    address, caption, cite, code, dfn, em, strong, th, var {
        font-weight: normal;
        font-style: normal;
    }
    ol, ul {
        list-style: none;
    }
    caption, th {
        text-align: left;
    }
    h1, h2, h3, h4, h5, h6, i {
        font-weight: normal;
        font-style: normal;
        font-size: 100%;
    }
    q:before, q:after {
        content:'';
    }
    abbr, acronym {
        border: 0;
    }
    body {
        font-family: "Hiragino Sans GB","DroidSansFallback","Microsoft YaHei","微软雅黑",arial,simsun;
        color: #333;
        line-height: 22px;
        font-size: 16px;
    }
    html, body {width: 100%; height: 100%;}
    .wall {width: 100%; height: 100vh;
        background-image: url({{asset('img/icon-wall.jpg')}});
        overflow: hidden;
        background-color: #121936;
        background-size: 100% 100% ;
        background-position: center center;
        background-repeat: no-repeat;}
    .photos-wall {width:100%; height:100%;}
    .messages {width: 30%;  float: left;  position: relative; top: 52px; left: 0}
    .wall .photos {width: 75%; height: 50%; float: left; position: relative; top: 270px; left: 100px; padding-left: 130px;}
    .wall .photo-title {
        position: absolute;
        top: -280px; left: 50%;
        background: url(../img/title.png) no-repeat 0 0;
        background-size: 100% auto;
        width: 800px; height: 350px;
        margin-left: -350px;
    }
    /*
    .wall .photo-title{position: absolute; top:-137px ;left:50%; background: url(../img/title.png) no-repeat 0 0;
        background-size:380px 107px; width:380px; height: 107px; margin-left:-190px;}*/
    .wall .photo-content{width:100%;height: 100%; margin:0 auto; position: relative;}
    .wall .photo {position: absolute;}
    .wall .photo .photo-inner{position: relative; width:100%;height: 100%;}
    .wall .photo .photo-inner .img-wrap{position: absolute; top:0; left:0;}
    .wall .photo .photo-inner .old{z-index: 10; opacity: 1; -webkit-transform-origin: center center;  /*-webkit-transition:all 2s linear;*/}
    .wall .photo .photo-inner .new{z-index: 11; opacity: 0; -webkit-transform-origin: center center; /*-webkit-transition:all 2s linear;*/}
    .wall .photo .photo-inner .show{-webkit-animation: show_photo 2s ease-in-out;}
    .wall .photo .photo-inner .hide{-webkit-animation: hide_photo 2s ease-in-out;}
    @-webkit-keyframes show_photo{
        0% {opacity:0;-webkit-transform:scale(0, 0);}
        100% { opacity:1;-webkit-transform:scale(1, 1);}
    }
    @-webkit-keyframes hide_photo{
        0% {opacity:1;}
        100% { opacity:0;}
    }
    /*.wall .photo .photo-inner .old{z-index: 10; opacity: 1; -webkit-transition:all 2s linear;}*/
    /*.wall .photo .photo-inner .new{z-index: 11; opacity: 0; -webkit-transition:all 2s linear;}*/
    /*.wall .photo .photo-inner .show{opacity: 1;}*/
    /*.wall .photo .photo-inner .hide{opacity: 0;}*/
    .wall .photo img {
        width: 100%; height: 100%;
        box-shadow: 0 5px 8px rgba(0, 0, 0, 0.8);
    }
    .wall .pos-0 {top:10px; left:0;width:65px; height:65px;}
    .wall .pos-1 {top:30px; left:70px;width:70px; height:70px;}
    .wall .pos-2 {top:0; left:145px;width:100px;height:100px;}
    .wall .pos-3 {top:30px; left:250px;width:70px; height:70px;}
    .wall .pos-4 {top:55px; left:325px;width:100px;height:100px;}
    .wall .pos-5 {top:70px; left:430px;width:85px;height:85px;}
    .wall .pos-6{top:15px; left:520px;width:65px;height:65px;}
    .wall .pos-7{top:-15px; left:595px;width:80px;height:80px;}
    .wall .pos-8{top:105px; left:40px;width:80px;height:80px;}
    .wall .pos-9{top:105px; left:125px;width:80px;height:80px;}
    .wall .pos-10{top:105px; left:210px;width:110px;height:110px;}
    .wall .pos-11{top:160px; left:325px;width:85px;height:85px;}
    .wall .pos-12{top:160px; left:415px;width:80px;height:80px;}
    .wall .pos-13{top:160px; left:500px;width:100px;height:100px;}
    .wall .pos-14{top:85px; left:520px;width:70px;height:70px;}
    .wall .pos-15{top:265px; left:-55px;width:80px;height:80px;}
    .wall .pos-16{top:190px; left:30px;width:70px;height:70px;}
    .wall .pos-17{top:190px; left:105px;width:100px;height:100px;}
    .wall .pos-18{top:220px; left:210px;width:110px;height:110px;}
    .wall .pos-19{top:250px; left:325px;width:85px;height:85px;}
    .wall .pos-20{top:245px; left:415px;width:75px;height:75px;}
    .wall .pos-21{top:265px; left:500px;width:85px;height:85px;}
    .wall .pos-22{top:70px; left:595px;width:85px;height:85px;}
    .wall .pos-23{top:160px; left:605px;width:75px;height:75px;}
    .wall .pos-24{top:240px; left:605px;width:65px;height:65px;}
    .wall .pos-25{top:310px; left:650px;width:60px;height:60px;}
    .wall .pos-26{top:265px; left:37px;width:65px;height:65px;}
    .wall .pos-27{
        top: 15px;
        left: 685px;
        width: 65px;
        height: 65px;}
    .wall .pos-28{top: -67px;
        left: 685px;
        width: 75px;
        height: 75px;}
    .wall .pos-29{top: 103px;
        left: -44px;
        width: 75px;
        height: 75px;}
    .wall .pos-30{top: -45px;
        left: -81px;
        width: 75px;
        height: 75px;}
    .wall .pos-31 {
        top: 295px;
        left: 105px;
        width: 60px;
        height: 60px;
    }
    .wall .pos-32 {
        top: 240px;
        left: 675px;
        width: 65px;
        height: 65px;
    }
    .wall .messages {width: 25%;  float: right; position: relative; top: 77px; left: 0;}
    /*.wall .messages {width: 25%;float: right;position: relative;top: 80px;left: 0;}*/
    /*.wall .message {  margin: 25px 35px 25px 10px;}*/
    .wall .message {margin: 25px 35px 25px 50px;}
    .wall .message span {line-height: 25px;color: #000000;font-size: 18px;display: inline-block;padding: 5px;margin: 0;}
    .wall .message{height: auto;overflow: hidden;opacity: 1;}
    .wall .message.newMsg {-webkit-animation: change_height .7s linear;}
    @-webkit-keyframes change_height{
        0% {opacity:0;height: 0;}
        100% { opacity:1;height:32px;}
    }
    .wall .message .message-inner{position: relative; float:right; display: inline-block; background: #ffffff; border: 1px solid #ffffff; border-radius: 4px;margin-right: 20px;}
    .wall .message .message-inner:before {content: '';width: 0;height: 0;border-width: 5px 11px 0px 11px;position: absolute;border-style: solid;border-color: transparent transparent transparent #ffffff;right: -19px;bottom: -1px;}
    #qrcode{width:105px;height:105px;position: absolute;top:20px;left:20px;}
    #qrcode img{width:100%;}
    #qrcode {background: white; padding: 5px;}
    .logo{color:#D13C3F;font-family: "Microsoft YaHei"; font-weight: bold; font-size: 13px; position: absolute;left:20px; bottom:20px;}
    .py-4 {
        padding: 0 !important;
    }
</style>
    <div id="main" class="wall main-container"></div>
    <div id="result" class="result"></div>
    <div id="allResult" class="all-result">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Result</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="tools" class="tools">
        <button
                class="pure-button"
                @click="toggle"
                :class="{'button-secondary': !running,
           'button-success': running}">@{{running? 'Stop' : 'Start'}}</button>
        <button class="pure-button button-warning" @click="reset">Reset</button>
        <button class="pure-button button-show" @click="showResult">Show Result</button>
    </div>
    <form id="resetForm" action="{{ route('guest.update', ['id' => 0]) }}">
        @csrf
        @method('PUT')
    </form>
    <form id="update" action="{{ route('main.update', ['id' => 0]) }}">
        @csrf
        @method('PUT')
        <input id="wonID" name="id" type="hidden">
    </form>
<script type="text/javascript">
    document.getElementById('navbarLaravel').style.display = 'none';

    var member = [];
    @foreach($allGuest as $key => $value)
        member[{{$key}}] = { "name" : {{$value->id}} };
    @endforeach
</script>
@endsection

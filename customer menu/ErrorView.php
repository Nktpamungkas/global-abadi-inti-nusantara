<b:if cond='data:blog.pageType == &quot;error_page&quot;'>
<section data-error='404'>
    <div class="container">
        <div class="row row1">
            <div class="col-md-12">
                <h3 class="center capital f1 wow fadeInLeft" data-wow-duration="2s">
                    Terjadi Kesalahan!
                </h3>
                <h5 id="error" class="center wow fadeInRight" data-wow-duration="2s">
                    404
                </h5>
                <p class="center wow bounceIn" data-wow-delay="2s">
                    Halaman Tidak Ditemukan!
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="cflask-holder" class="wow fadeIn" data-wow-delay="2800ms">
                    <span class="wow tada " data-wow-delay="3000ms">
                        <a href="?"><i class="fa fa-home fa-2x" data-wow-delay="3300ms"></i></a>
                        <i id="b1" class="bubble"></i><i id="b2" class="bubble"></i><i id="b3" class="bubble"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="links-wrapper col-md-6 col-md-offset-3">
                    <ul class="links col-md-9">
                    </ul>
                </div>
            </div>
       </div>
    </div>
</section>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'/>
<link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
<link rel="stylesheet" href="http://cdn.rawgit.com/editorkode/live/master/css/Errorpage1-animate.css"/>
<script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://cdn.rawgit.com/editorkode/live/master/js/Errorpage1-Countup.js"></script>
<script type="text/javascript" src="http://cdn.rawgit.com/editorkode/live/master/js/Errorpage1-wow.js"></script>

<script type="text/javascript">
    "use strict";
    var count = new countUp("error", 0, 404, 0, 7);

    window.onload = function() {
        // fire animation
        count.start();
    }
</script>

<!--Initiating the Wow Script-->
<script>  
    "use strict";
    var wow = new WOW(
        {
            animateClass: 'animated',
            offset:       100
        }
    );
    wow.init();
</script>

<style>
    .content,.navbar{display:none}
    body{
        font-family: 'Open Sans', sans-seriff;
        font-size: 14px;
        color: #46A3FA;
        background-color: #E8E8E8;
        background-repeat: repeat;
    }
    h1,h2,h3,h4,h5,h6{
        font-family: 'Open Sans', sans-seriff;
        font-weight: 700;
    }
    h5{font-size: 150px; margin-top: 0px;}
    .center{
        text-align: center;
    }
    .capital{
        text-transform: uppercase;
    }
    .f1{font-size: 34px}
    @keyframes bubbles1  
    {
    0%  {opacity: 0; width:7px; height:7px; top:100px; left:70px;}
    25%  {opacity: .25; width:8px; height:8px;  top:90px; left:70px;}
    50%  {opacity: .5; width:9px; height:9px;  top:70px; left:70px;}
    75%  {opacity: .75; width:10px; height:10px;  top:60px; left:65px;}
    100%  {opacity: 0; width:11px; height:11px; top:30px; left:70px;}

    }
    @-webkit-keyframes bubbles1 
    {
    0%  {opacity: 0; width:5px; height:5px; top:100px; left:70px;}
    25%  {opacity: .25; width:6px; height:6px;  top:90px; left:70px;}
    50%  {opacity: .5; width:7px; height:7px;  top:50px; left:70px;}
    75%  {opacity: .75; width:9px; height:9px;  top:40px; left:65px;}
    100%  {opacity: 0; width:10px; height:10px; top:10px; left:75px;}

    }
    #cflask-holder span{
        height: 150px;
        width: 150px;
        display: block;
        background-color: #fff;
        margin:0px auto;
        text-align: center;
        border-radius: 150px;
        position: relative;
    }
    #cflask-holder span i{
        padding: 40px 0px 0px 0px;
        font-size: 80px;
    }
    #cflask-holder span i#b1{  
        position: absolute;
        min-width: 10px;
        min-height: 10px;
        border-radius: 50%;
        background-color: #46A3FA;
        left: 70px;
        top: 70px;
        -webkit-animation: bubbles1 infinite linear 1s;
        animation: bubbles1 infinite linear 1s;
        padding: 0px;
    }
    #cflask-holder span i#b2{  
        position: absolute;
        min-width: 10px;
        min-height: 10px;
        border-radius: 50%;
        background-color: #46A3FA;
        left: 70px;
        top: 70px;
        -webkit-animation: bubbles1 infinite linear 2s;
        animation: bubbles1 infinite linear 2s;
        padding: 0px;
    }
    #cflask-holder span i#b3{  
        position: absolute;
        min-width: 10px;
        min-height: 10px;
        border-radius: 50%;
        background-color: #46A3FA;
        left: 70px;
        top: 70px;
        -webkit-animation: bubbles1 infinite linear 2500ms;
        animation: bubbles1 infinite linear 2500ms;
        padding: 0px;
    }
    .row1 p{
        font-size: 35px;
    }
    .search-form{
        margin-top: 20px;
    }
    input[type="text"]{
        height: 42px;
        border: 1px solid #e6e4e4;
        outline-color: #ccc;

        transition: all .2s linear; -moz-transition: all .2s linear; -webkit-transition : all .2s linear; -o-transition: all .2s linear;
    }
    input[type="text"]:focus{
        outline-color: #46A3FA;
    }
    input[type="submit"]{
        height: 42px;
        border: 1px solid #447BAF;
        background-color: #46A3FA;
        color: #fff;
        text-transform: uppercase;
        transition: all .2s linear; -moz-transition: all .2s linear; -webkit-transition : all .2s linear; -o-transition: all .2s linear;
    }
    input[type="submit"]:hover{
        background-color: #447BAF;
    }
    .links-wrapper{
        margin-top: 20px;
    }
    ul.links{
        float: none;
        display: block;
        margin: 0px auto;
    }
    ul.links li{
        list-style-type: none;
        display: block;
        float: left;
        margin-right: 10px;
        margin-bottom: 20px;
    }
    ul.links li a{
        height: 50px;    
        width: 50px;
        min-width: 50px;
        display: inline-block;
        padding: 3px 0px;
        background-color: #fff;
        border-radius: 50%;
        text-align: center;
        color: #46A3FA;
        transition: all .2s linear; -moz-transition: all .2s linear; -webkit-transition : all .2s linear; -o-transition: all .2s linear;
    }
    ul.links li a:hover{background-color: #46A3FA;color: #fff;}
    ul.links li a i{padding: 10px 0px;}
</style>
</b:if>
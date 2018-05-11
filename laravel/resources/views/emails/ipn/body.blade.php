<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div style="padding:8px; box-sizing:border-box;font-family:sans-serif;">
            <h1 style="display:inline; color:#333; margin-top:40px;margin-bottom:40px; padding:3px 0px; text-transform:uppercase; font-weight:300;">IPN</h1>
            <p style="margin-bottom:0px;">Hi <?php echo $name; ?>,</p> 
            <p style="margin-bottom: 0px;"><?php echo $content; ?></p>

            <p style="margin-bottom:0px;font-weight:bold;">Many thanks,</p>
            <p style="margin-bottom:0px;font-weight:bold;">{{Config::get('params.site_name')}}</p>
            <br>
            <div style="width:200px;margin-bottom:10px;"><a href="{{ URL::to('/') }}"><img src="{{ asset('front/images/logo.png') }}" alt="logo" style="width:100%"></a>
            </div>
            <h4 style="margin-bottom:0px">Stay In Touch with us</h4>
            <a href="https://www.facebook.com/TaskMatch-1528535830788580/info/?tab=page_info&edited=category" target="_blank" style="display:inline-block;">
                <img style="width:38px;height:38px;border-radius:50%;" src="{{ URL::to('front/images/emails/facebook.png') }}"></a>
            <a href="https://twitter.com/Task_Match" target="_blank" style="display:inline-block;    vertical-align: sub;"><img style="width:47px;height:47px;border-radius:50%; " src="{{ URL::to('front/images/emails/twitter.png') }}"></a>
            <a href="https://www.instagram.com/taskmatch/?hl=en" target="_blank" style="display:inline-block;"><img style="width: 35px;height: 35px;border-radius: 50%;margin-bottom: 3px" src="{{ URL::to('front/images/emails/instagram.png') }}"></a>
            <br>
            <small style="margin-bottom:0px;">
                Need more help getting started? Check out our <a style="color:#15c;font-size:12px;"href="<?php echo url('faqs') ?>">FAQs</a> or <a style="color:#15c;font-size:12px;"href="<?php echo url('contact-us') ?>">contact us</a> - We're here to help you.
            </small>
        </div>
    </body>
</html>

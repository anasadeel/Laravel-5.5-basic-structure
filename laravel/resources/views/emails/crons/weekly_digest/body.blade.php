<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div style="padding:8px; box-sizing:border-box;font-family:sans-serif;">
            <h1 style="display:inline; color:#333; margin-top:40px;margin-bottom:40px; padding:3px 0px; text-transform:uppercase; font-weight:300;">Weekly Digest</h1>
            <p style="margin-bottom:0px;">Hi <?php echo $name; ?>,</p> 
            @foreach ($model as $key => $value)
            @foreach ($value as $value2)
            <p style="margin-bottom:0px;"><strong>{{ucfirst($value2->sm_code)}}</strong> <span>{{$value2->share}}</span> Shares</p>
            @endforeach
            @endforeach

            @include('emails.email_footer')
        </div>
    </body>
</html>

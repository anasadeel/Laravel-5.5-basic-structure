<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div style="padding:8px; box-sizing:border-box;font-family:sans-serif;">
            <h1 style="display:inline; color:#333; margin-top:40px;margin-bottom:40px; padding:3px 0px; text-transform:uppercase; font-weight:300;">Unsubscibe</h1>
            <p style="margin-bottom:0px;">Hi <?php echo $name; ?>,</p>
            <p style="margin-bottom:0px;">
                Your account has been successfully unsubscribed.
            </p>

            @include('emails.email_footer')
        </div>
    </body>
</html>
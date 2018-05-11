<style>
    #cover {
        background: url("http://www.aveva.com/Images/ajax-loader.gif") no-repeat scroll center center #FFF;
        position: absolute;
        height: 100%;
        width: 100%;
    }
</style>
<div id="cover" style="display: none;"></div>
<script>
    successHtml = '<div class="alert alert-success alert-dismissable"><a href="#" class="pull-right" data-dismiss="alert" aria-label="close">&times;</a>' +
            '<h4><i class="icon fa fa-check"></i> Alert!</h4>' +
            '<strong>Successfully Connected</strong>' +
            '</div>';
    function checkMember(type, status, accountId, access_token, data) {
        $.ajax(
                {
                    url: "<?php echo url('social-login'); ?>",
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        type: type,
                        accountStatus: status,
                        accountId: accountId,
                        access_token: access_token
                    },
                    beforeSend: function () {
                        $('#cover').css('display', 'block');
                        console.log('Loading . . . .');
                    },
                    complete: function () {
                        $('#cover').css('display', 'none');
                        console.log('complete');
                    },
                    success: function (result) {
                        if (result.error === 0)
                        {
                            if (type === 'facebook') {
                                checkPage(type, data);
                            }
                            if (type === 'linkedin') {
                                $("#linkedInAuth")[0].click();
                            }
                            if (type === 'google') {
                                alert('Successfully Connected!');
                                window.location.href = '<?php echo url('dashboard'); ?>';
                            }
                            if (type === 'instagram') {
                                $('#socialAccountErrors').html(successHtml).show();
//                                alert('Successfully Connected!');
//                                window.location.href = '<?php //echo url('social-media');   ?>';
                            }
                            if (type === 'pinterest') {
                                checkPage(type, data);
//                                alert('Successfully Connected!');
//                                window.location.href = '<?php // echo url('social-media');    ?>';
                            }
                        } else {
                            alert("Whoops! Something went wrong.");
                        }
                    }
                });
    }
    function checkPage(type, data) {
        $.ajax(
                {
                    url: "<?php echo url('social-pages'); ?>",
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        type: type,
                        data: data
                    },
                    success: function (result) {
                        if (result.error === 0)
                        {
                            $('#socialAccountErrors').html(successHtml).show();
                        } else {
                            alert("Whoops! Something went wrong.");
                        }
                    }
                });
    }
//
//    function unseenMessages() {
//
//        $.ajax({
//            url: "<?php //echo url("");                                 ?>/messages/unseen",
//            type: 'get',
//            dataType: 'html',
//            success: function (result) {
//
//                $('.unseen_messages').html(result);
//            }
//        });
//    }
//
//    function unseenNotifications() {
//
//        $.ajax({
//            url: "<?php // echo url("");                                 ?>/notifications/unseen",
//            type: 'get',
//            dataType: 'html',
//            success: function (result) {
//
//                $('.unseen_notifications').html(result);
//            }
//        });
//    }
//    setInterval(checkCron, 1000);
//    function checkCron() {
//        $.get(<?php // echo url('run/post/cron');         ?>, function (data) {
//            console.log(data);
//        });
//}
</script>

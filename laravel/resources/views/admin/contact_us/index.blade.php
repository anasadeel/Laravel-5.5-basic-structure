@extends('admin/admin_template')
<?php

use App\Functions\Functions;
?>

@section('content')
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        @include('admin/commons/errors')
        <!-- PRODUCT LIST -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Contacts ( Total : {{ count($contactus) }} ) </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <?php if (count($contactus) > 0) { ?>
                    <ul class="products-list product-list-in-box">				
                        <table class="table table-striped">
                            <thead>
                                <tr>     
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Message</td>
                                    <td>Created</td>
                                    <td>Action</td>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contactus as $contacts)
                                <tr>                  
                                    <td>{{ $contacts->name }}</td>
                                    <td>{{ $contacts->email}}</td>
                                    <td><?php echo Functions::stringTrim($contacts->message, 40, 0, 40) ?></td>
                                    <td>{{ date('d M Y',strtotime($contacts->created_at))}}</td>
                                    <td><a href="contact-detail/{{$contacts->id}}" class="btn btn-info">Detail</a>
                                        <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#myModal" data-link="{{ URL('admin/contact/delete/'.$contacts->id) }}"><i class="fa fa-trash"></i> </button>
                                    </td>                                    
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>

                    </ul>
                    <?php echo $contactus->render(); ?>
                    @include('admin/commons/delete_modal')
                <?php } else {
                    ?>
                    <div class="">
                        No Data found. . .
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <!-- /.box-body -->
    </div>
</div>
<!-- /.col -->
</div>
<!-- /.row -->	
<script>
    jQuery('.delete').click(function ()
    {
        $('#closemodal').attr('href', $(this).data('link'));
    });
</script>
@endsection
@extends('layouts.admin')
@section('content')

    @component('components.admin.page-name',[
    'pageName'=>'Create user'])
    @endcomponent
    <!-- Main content -->
    <section class="content">

        <div class="box box-primary col-md-5 col-lg-5">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action=" {{ url('/') }}/admin/users" method="post" id="storeUserForm">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="first_name">First name</label>
                        <input class="form-control" type="text" placeholder="First name" id="first_name" name="first_name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input class="form-control" type="text" placeholder="Last name" id="last_name" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <label for="roles">Role</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="userRole[]" id="roleAdmin" value="1">
                                Admin
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="userRole[]" id="roleUser" value="2" checked>
                                User
                            </label>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="btnSubmitUser">Submit</button>
                </div>
            </form>
            <div id="notificationContent" class="col-md-2 col-lg-6"></div>
        </div>

    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            // $("#carouselExampleControls").carousel();

            $(document).on('submit','#storeUserForm',function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                $.ajax({
                    type:'POST',
                    url:baseURL+'/admin/users',
                    data:fd,
                    processData: false,
                    contentType: false,
                    beforeSend:function(){
                        $('#btnSubmitUser').html('Wait ...');
                        $('#btnSubmitUser').addClass('disabled');
                        $('#btnSubmitUser').attr('disabled',true);
                    },
                    success:function(data) {
                        console.log(data);
                        data = JSON.parse(data);
                        if(data.success){
                            $('#notificationContent').html(`<div class="alert alert-dismissible alert-success" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        }else{
                            $('#notificationContent').html(`<div class="alert alert-dismissible alert-success" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        }
                        document.querySelector('#storeUserForm').reset();
                    },
                    fail:function (xhr, status, errorMsg) {
                        $('#btnSubmitUser').html('Submit');
                        $('#btnSubmitUser').removeClass('disabled');
                        $('#btnSubmitUser').removeAttr('disabled');
                        let responseText = JSON.parse(xhr.responseText);
                        let warnings =``;
                        for(let m in responseText.errors){
                            warnings+=responseText.errors[m][0]+"<br/>";
                        }
                        $('#notificationContent').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${warnings}</div>`);

                    },
                    error:function (xhr, status, errorMsg) {
                        $('#btnSubmitUser').html('Submit');
                        $('#btnSubmitUser').removeClass('disabled');
                        $('#btnSubmitUser').removeAttr('disabled');
                        let responseText = JSON.parse(xhr.responseText);
                        let warnings =``;
                        for(let m in responseText.errors){
                            warnings+=responseText.errors[m][0]+"<br/>";
                        }
                        $('#notificationContent').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${warnings}</div>`);

                    }
                });
            });
        });
    </script>
@endsection
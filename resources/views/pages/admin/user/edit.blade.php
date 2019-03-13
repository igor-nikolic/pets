@extends('layouts.admin')
@section('content')

    @component('components.admin.page-name',[
    'pageName'=>'Edit user'])
    @endcomponent
    <!-- Main content -->
    <section class="content">

        <div class="box box-primary col-md-5 col-lg-5">
            <!-- /.box-header -->
            <!-- form start -->
            @isset($userData)
                <form role="form" action=" {{ url('/') }}/admin/users/{{ $userData->id }}" method="post" id="editUserForm">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input class="form-control" type="text" placeholder="First name" id="first_name" name="first_name" value="{{ $userData->first_name }}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input class="form-control" type="text" placeholder="Last name" id="last_name" name="last_name" value="{{ $userData->last_name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ $userData->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Change password</label>
                            <input type="checkbox" id="changePassword" name="changePassword" checked>
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
                                    <input type="radio" name="userRole[]" id="roleAdmin" value="1" {{ ($userData->role_id == 1) ? 'checked':''}}>
                                    Admin
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="userRole[]" id="roleUser" value="2" {{ ($userData->role_id == 2) ? 'checked':''}}>
                                    User
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="btnEditUser">Submit</button>
                        <div id="btnHolderDiv" style="display: inline-block;">
                            @if(is_null($userData->deleted_at))
                                <button type="button" class="btn btn-danger" id="deactivateUser">Deactivate this user</button>
                            @else
                                <button type="button" class="btn btn-info" id="reactivateUser">Reactivate this user</button>
                            @endif
                        </div>
                    </div>
                </form>

            <input type="hidden" value="{{ $userData->id }}" id="userId"/>
                <div id="notificationContent" class="col-md-2 col-lg-6">awdawd</div>
            @endisset

        </div>

    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click','#changePassword',function () {
               if($(this).is(':checked')) {
                   $('#password').attr('disabled',false).removeClass('disabled');
                   $('#confirmpassword').attr('disabled',false).removeClass('disabled');
               }
               else {
                   $('#password').attr('disabled',true).addClass('disabled');
                   $('#confirmpassword').attr('disabled',true).addClass('disabled');
               }
            });

            $(document).on('submit','#editUserForm',function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                $.ajax({
                    type:'post',
                    url:baseURL+'/admin/users/'+$('#userId').val(),
                    data:fd,
                    processData: false,
                    contentType: false,
                    beforeSend:function(){
                        $('#btnEditUser').html('Wait ...');
                        $('#btnEditUser').addClass('disabled');
                        $('#btnEditUser').attr('disabled',true);
                    },
                    success:function(data) {
                        $('#btnEditUser').html('Submit');
                        $('#btnEditUser').removeClass('disabled');
                        $('#btnEditUser').removeAttr('disabled');
                        console.log(data);
                        data = JSON.parse(data);
                        if(data.success){
                            $('#notificationContent').html(`<div class="alert alert-dismissible alert-success" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        }else{
                            $('#notificationContent').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        }
                        // document.querySelector('#editUserForm').reset();
                    },
                    fail:function (xhr, status, errorMsg) {
                        $('#btnEditUser').html('Submit');
                        $('#btnEditUser').removeClass('disabled');
                        $('#btnEditUser').removeAttr('disabled');
                        let responseText = JSON.parse(xhr.responseText);
                        let warnings =``;
                        for(let m in responseText.errors){
                            warnings+=responseText.errors[m][0]+"<br/>";
                        }
                        $('#notificationContent').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${warnings}</div>`);

                    },
                    error:function (xhr, status, errorMsg) {
                        $('#btnEditUser').html('Submit');
                        $('#btnEditUser').removeClass('disabled');
                        $('#btnEditUser').removeAttr('disabled');
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

            function url_redirect(url){
                let X = setTimeout(function(){
                    window.location.replace(url);
                    return true;
                },300);

                if( window.location = url ){
                    clearTimeout(X);
                    return true;
                } else {
                    if( window.location.href = url ){
                        clearTimeout(X);
                        return true;
                    }else{
                        clearTimeout(X);
                        window.location.replace(url);
                        return true;
                    }
                }
                return false;
            };
            $(document).on('click','#deactivateUser',function () {
                let btn = $(this);
                btn.addClass('disabled');
                btn.attr('disabled');
                btn.html('Wait...');
                $.ajax({
                    method:'delete',
                    url:baseURL+'/admin/users/'+$('#userId').val(),
                    data:{
                        '_token':csrf
                    },
                    success:function (data) {
                        console.log(data);
                        data = JSON.parse(data);
                        if(data.success) {
                             $('#btnHolderDiv').html(`<button type="button" class="btn btn-info" id="reactivateUser">Reactivate this user</button>`);
                        }else{
                            alert(data.message);
                        }
                    }
                });
            });
            $(document).on('click','#reactivateUser',function () {
                let btn = $(this);
                btn.addClass('disabled');
                btn.attr('disabled');
                btn.html('Wait...');
                $.ajax({
                    method:'post',
                    url:baseURL+'/admin/users/reactivate/'+$('#userId').val(),
                    data:{
                        '_token':csrf
                    },
                    success:function (data) {
                        console.log(data);
                        data = JSON.parse(data);
                        if(data.success) {
                            $('#btnHolderDiv').html(`<button type="button" class="btn btn-danger" id="deactivateUser">Deactivate this user</button>`);
                        }else{
                            alert(data.message);
                        }
                    }
                });
            });

        });
    </script>
@endsection
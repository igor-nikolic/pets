@extends('layouts.admin')
@section('content')

    @component('components.admin.page-name',[
    'pageName'=>'Create breed'])
    @endcomponent
    <!-- Main content -->
    <section class="content">

        <div class="box box-primary col-md-5 col-lg-5">
            <form role="form" action=" {{ url('/') }}/admin/breeds" method="post" id="storeBreedForm">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="breed_name">Breed name</label>
                        <input class="form-control" type="text" placeholder="Breed name" id="breed_name" name="breed_name">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="btnSubmitBreed">Submit</button>
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

            $(document).on('submit','#storeBreedForm',function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                $.ajax({
                    type:'POST',
                    url:baseURL+'/admin/breeds',
                    data:fd,
                    processData: false,
                    contentType: false,
                    beforeSend:function(){
                        $('#btnSubmitBreed').html('Wait ...');
                        $('#btnSubmitBreed').addClass('disabled');
                        $('#btnSubmitBreed').attr('disabled',true);
                    },
                    success:function(data) {
                        $('#btnSubmitBreed').html('Submit');
                        $('#btnSubmitBreed').removeClass('disabled');
                        $('#btnSubmitBreed').removeAttr('disabled');
                        data = JSON.parse(data);
                        if(data.success){
                            $('#notificationContent').html(`<div class="alert alert-dismissible alert-success" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        }else{
                            $('#notificationContent').html(`<div class="alert alert-dismissible alert-success" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        }
                        document.querySelector('#storeBreedForm').reset();
                    },
                    fail:function (xhr, status, errorMsg) {
                        $('#btnSubmitBreed').html('Submit');
                        $('#btnSubmitBreed').removeClass('disabled');
                        $('#btnSubmitBreed').removeAttr('disabled');
                        let responseText = JSON.parse(xhr.responseText);
                        let warnings =``;
                        for(let m in responseText.errors){
                            warnings+=responseText.errors[m][0]+"<br/>";
                        }
                        $('#notificationContent').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${warnings}</div>`);

                    },
                    error:function (xhr, status, errorMsg) {
                        $('#btnSubmitBreed').html('Submit');
                        $('#btnSubmitBreed').removeClass('disabled');
                        $('#btnSubmitBreed').removeAttr('disabled');
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
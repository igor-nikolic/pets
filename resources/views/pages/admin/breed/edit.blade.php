@extends('layouts.admin')
@section('content')

    @component('components.admin.page-name',[
    'pageName'=>'Edit breed'])
    @endcomponent
    <!-- Main content -->
    <section class="content">

        <div class="box box-primary col-md-5 col-lg-5">
            <!-- /.box-header -->
            <!-- form start -->
            @isset($breedData)
                <form role="form" action=" {{ url('/') }}/admin/breed/{{ $breedData->id }}" method="post"
                      id="editBreedForm">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="breed_name">Breed name</label>
                            <input class="form-control" type="text" placeholder="Breed name" id="breed_name"
                                   name="breed_name" value="{{ $breedData->name }}">
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="btnEditBreed">Submit</button>
                        <button type="button" class=" btn btn-danger" id="btnDeleteBreed">Delete breed</button>
                    </div>
                </form>

                <input type="hidden" value="{{ $breedData->id }}" id="breedId"/>
                <div id="notificationContent" class="col-md-2 col-lg-6"></div>
            @endisset

        </div>

    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('submit', '#editBreedForm', function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                $.ajax({
                    type: 'post',
                    url: baseURL + '/admin/breeds/' + $('#breedId').val(),
                    data: fd,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('#btnEditBreed').html('Wait ...');
                        $('#btnEditBreed').addClass('disabled');
                        $('#btnEditBreed').attr('disabled', true);
                    },
                    success: function (data) {
                        $('#btnEditBreed').html('Submit');
                        $('#btnEditBreed').removeClass('disabled');
                        $('#btnEditBreed').removeAttr('disabled');
                        console.log(data);
                        data = JSON.parse(data);
                        if (data.success) {
                            $('#notificationContent').html(`<div class="alert alert-dismissible alert-success" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        } else {
                            $('#notificationContent').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        }
                    },
                    fail: function (xhr, status, errorMsg) {
                        $('#btnEditBreed').html('Submit');
                        $('#btnEditBreed').removeClass('disabled');
                        $('#btnEditBreed').removeAttr('disabled');
                        let responseText = JSON.parse(xhr.responseText);
                        let warnings = ``;
                        for (let m in responseText.errors) {
                            warnings += responseText.errors[m][0] + "<br/>";
                        }
                        $('#notificationContent').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${warnings}</div>`);

                    },
                    error: function (xhr, status, errorMsg) {
                        $('#btnEditBreed').html('Submit');
                        $('#btnEditBreed').removeClass('disabled');
                        $('#btnEditBreed').removeAttr('disabled');
                        let responseText = JSON.parse(xhr.responseText);
                        let warnings = ``;
                        for (let m in responseText.errors) {
                            warnings += responseText.errors[m][0] + "<br/>";
                        }
                        $('#notificationContent').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${warnings}</div>`);

                    }
                });
            });

            function url_redirect(url) {
                let X = setTimeout(function () {
                    window.location.replace(url);
                    return true;
                }, 300);

                if (window.location = url) {
                    clearTimeout(X);
                    return true;
                } else {
                    if (window.location.href = url) {
                        clearTimeout(X);
                        return true;
                    } else {
                        clearTimeout(X);
                        window.location.replace(url);
                        return true;
                    }
                }
                return false;
            };
            $(document).on('click', '#btnDeleteBreed', function () {
                let btn = $(this);
                btn.addClass('disabled');
                btn.attr('disabled');
                btn.html('Wait...');
                $.ajax({
                    method: 'delete',
                    url: baseURL + '/admin/breeds/' + $('#breedId').val(),
                    data: {
                        '_token': csrf
                    },
                    success: function (data) {
                        console.log(data);
                        data = JSON.parse(data);
                        if (data.success) {
                            alert(data.message);
                            url_redirect(baseURL+'/admin/breeds/create');
                        } else {
                            alert(data.message);
                        }
                    }
                });
            });

        });
    </script>
@endsection
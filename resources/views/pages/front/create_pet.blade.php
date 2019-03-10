@extends('layouts.front')
@section('content')
    <div class="row">
        <div class="col-md-6">awdawd</div>
        <div class="col-md-6">
            <form action="{{ url('/pets') }}" method="post" enctype="multipart/form-data" id="storePetForm">
                @csrf
                <div class="form-group">
                    <label for="petName">Pet name</label>
                    <input type="text" class="form-control" id="petName" name="petName" placeholder="Pet name">
                </div>
                <div class="form-group">
                    <label for="petBirthday">Pet birthday</label>
                    <input type="date" id="petBirthday" name="petBirthday"
                           min="1900-01-01" max="{{ date('Y-m-d') }}">
                </div>
                <div class="form-group">
                    <label for="petGender">Pet gender</label>
                    <input type="radio" name="petGender[]" id="petMale" value="m"/> Male
                    <input type="radio" name="petGender[]" id="petFemale" value="f"/> Female
                </div>
                <div class="form-group">
                    <label for="petBreed">Pet breed</label>
                    <select id="petBreed" class="js-example-basic-single" name="petBreed">
                        @isset($breeds)
                            @foreach($breeds as $breed)
                                <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="form-group">
                    <label for="petMother">Pets mother</label>
                    <select id="petMother" class="js-example-basic-single" name="petMother">
                        <option value="0">Unknown mother</option>
                        @isset($parents)
                            @foreach($parents as $parent)
                                @if($parent->gender == 'f')
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endif
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="form-group">
                    <label for="petFather">Pets father</label>
                    <select id="petFather" class="js-example-basic-single" name="petFather">
                        <option value="0">Unknown father</option>
                        @isset($parents)
                            @foreach($parents as $parent)
                                @if($parent->gender == 'm')
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endif
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="form-group">
                    <label for="petPhotos">Add some pet photos</label>
                    <input type="file" multiple class="form-control-file" id="petPhotos" accept="image/jpeg" name="petPhotos[]">
                </div>
                <button type="submit" class="btn btn-success" name="btnSubmitPet" id="btnSubmitPet">Insert a new pet</button>
                <button type="reset" class="btn btn-info">Reset form</button>
            </form>
            <div id="notificationContent" class="col-md-2 col-lg-6">

            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
@endsection
@section('scripts')
@parent
<script src="{{asset('/')}}js/select2/select2.full.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();

            $(document).on('submit','#storePetForm',function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                $.ajax({
                    type:'POST',
                    url:baseURL+'/pets',
                    data:fd,
                    processData: false,
                    contentType: false,
                    success:function(data) {
                        data = JSON.parse(data);
                        $('#notificationContent').html(`<div class="alert alert-dismissible alert-success" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>You have successfully inserted a pet! Click <a href='${baseURL}/pets/${data.petId}' target='_blank'>here</a> to see your added pet.</div>`);
                        if(data.petGender == 'm') $('#petFather').append(`<option value='${data.petId}'>${data.petName}</option>`);
                        else if(data.petGender =='f') $('#petMother').append(`<option value='${data.petId}'>${data.petName}</option>`);
                        document.querySelector('#storePetForm').reset();
                    },
                    fail:function (xhr, status, errorMsg) {
                        let responseText = JSON.parse(xhr.responseText);
                        let warnings =``;
                        for(let m in responseText.errors){
                            warnings+=responseText.errors[m][0]+"<br/>";
                        }
                        $('#notificationContent').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${warnings}</div>`);
                    },
                    error:function (xhr, status, errorMsg) {
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
@section('styles')
@parent
<link href="{{ asset('/') }}css/select2/select2.min.css" rel='stylesheet' type='text/css' />
@endsection
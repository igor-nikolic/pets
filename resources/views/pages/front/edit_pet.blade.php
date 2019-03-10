@extends('layouts.front')
@section('content')
    <!-- single -->
    <div class="single welcome">
        <div class="container">
            {{--<h3 class="agileits-title">Pet info</h3>--}}
            <div class="markets-grids">
                <div class="col-md-7 w3ls_single_left">
                    <div class="w3ls_single_left_grid1">
                        @isset($petData)
                            <form action="{{ url('/') }}/pets/{{ $petData->pet_id }}" method="post" id="editPetForm">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="petName">Pet name</label>
                                    <input type="text" class="form-control" id="petName" name="petName" placeholder="Pet name" value="{{ $petData->pet_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="petBirthday">Pet birthday</label>
                                    <input type="date" id="petBirthday" name="petBirthday"
                                           min="1900-01-01" max="{{ date('Y-m-d') }}" value="{{ $petData->birthday }}">
                                </div>
                                <div class="form-group">
                                    <label for="petGender">Pet gender</label>
                                    <input type="radio" name="petGender[]" id="petMale" value="m" {{ ($petData->gender =='m') ? 'checked': '' }}/> Male
                                    <input type="radio" name="petGender[]" id="petFemale" value="f" {{ ($petData->gender =='f') ? 'checked': '' }}/> Female
                                </div>
                                <div class="form-group">
                                    <label for="petBreed">Pet breed</label>
                                    <select id="petBreed" class="js-example-basic-single" name="petBreed">
                                        @isset($breeds)
                                            @foreach($breeds as $breed)
                                                <option value="{{ $breed->id }}" {{ ($petData->breed_name == $breed->name) ? 'selected' : '' }}>{{ $breed->name }}</option>
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
                                                    <option value="{{ $parent->id }}" {{ ($petData->mother_id == $parent->id) ? 'selected' : '' }}>{{ $parent->name }}</option>
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
                                                    <option value="{{ $parent->id }}" {{ ($petData->father_id == $parent->id) ? 'selected' : '' }}>{{ $parent->name }}</option>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<label for="petPhotos">Add some pet photos</label>--}}
                                    {{--<input type="file" multiple class="form-control-file" id="petPhotos" accept="image/jpeg" name="petPhotos[]">--}}
                                {{--</div>--}}
                                <button type="submit" class="btn btn-success" name="btnSubmitPet" id="btnSubmitPet">Update pet</button>
                                <button type="button" class="btn btn-danger" id="deletePet">Delete pet</button>
                                <input type="hidden" id="petId" name="petId" value="{{ $petData->pet_id }}"/>
                            </form>
                        @endisset
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="w3ls_single_left_grid">
                        <div class="w3ls_single_left_grid_right">
                            @isset($petData)
                                Click <a href="{{ url('/') }}/pets/{{$petData->pet_id}}">here</a> to visit this pet
                            @endisset
                            <div id="notificationContent" class="col-md-2 col-lg-6"></div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //single -->
@endsection
@section('scripts')
    @parent
    <script src="{{asset('/')}}js/select2/select2.full.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
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
           $(document).on('click','#deletePet',function () {
               $.ajax({
                   method:'delete',
                   url:baseURL+'/pets/'+$('#petId').val(),
                   data:{
                       '_token':csrf
                   },
                   success:function (data) {
                       console.log(data);
                       data = JSON.parse(data);
                       if(data.success) {
                           alert(data.message);
                           url_redirect(baseURL+'/pets/create');
                       }else{
                           alert(data.message);
                       }
                   }
               });
           });

            $(document).on('submit','#editPetForm',function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                $.ajax({
                    type:'post',
                    url:baseURL+'/pets/'+$('#petId').val(),
                    data:fd,
                    processData: false,
                    contentType: false,
                    success:function(data) {
                        data = JSON.parse(data);
                        if(data.success){
                            $('#notificationContent').html(`<div class="alert alert-dismissible alert-success" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                            if(data.petGender == 'm') $('#petFather').append(`<option value='${data.petId}'>${data.petName}</option>`);
                            else if(data.petGender =='f') $('#petMother').append(`<option value='${data.petId}'>${data.petName}</option>`);
                            document.querySelector('#storePetForm').reset();
                        }else{
                            $('#notificationContent').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        }

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
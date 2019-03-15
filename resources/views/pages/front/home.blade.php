@extends('layouts.front')

@section('content')
    <div class="row">

        <div class="col-md-6 col-lg-6 text-center panel panel-default">
            <h2>Our pets</h2>
            @isset($petsData)
                @foreach($petsData as $p)
                    <div class="row">
                        <div class="col-md-6 col-lg-6"><img
                                    src="{{ asset('/images/pets/') }}/{{ $p->photo->path }}" alt="{{ $p->photo->alt }}" width="300px"
                                    height="200px"/></div>
                        <div class="col-md-6 col-lg-6">
                            <table class="table">
                                <tr>
                                    <td colspan="2"><h4>Dog info</h4></td>
                                </tr>
                                <tr>
                                    <td><strong>Name:</strong></td>
                                    <td>{{ $p->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Breed:</strong></td>
                                    <td>{{ $p->pet_breed }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><a href="{{ url('/pets') }}/{{$p->id}}">
                                            <button type="button" class="btn btn-info">View this pet</button>
                                        </a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
            @endisset


        </div>

        <div class="col-md-6 col-lg-6 text-center panel panel-default">
            <h2>Our pet breeds</h2>
            @isset($breedData)
                @foreach($breedData as $b)
                    <div class="row my-30">
                        <div class="col-md-6 col-lg-6"><img
                                    src="{{ asset('/images/breeds/') }}/{{ $b->image }}" width="300px"
                                    height="200px"/></div>
                        <div class="col-md-6 col-lg-6" >
                            <h3>{{ $b->name }}</h3>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>

@endsection


@section('scripts')
    @parent
    {{--checking for errors--}}
    @if($errors->any())
        <script type="text/javascript">
            $(document).ready(function () {
                let html = "<ul>";
                @foreach($errors->all() as $err)
                    html += "<li><h4 class='agileinfo_sign'>{{ $err }}</h4></li>";
                @endforeach
                    html += '</ul>';
                $('#notificationModal').find('#notificationContent').html(html);
                $('#notificationModal').modal('show');
            });
        </script>
    @endif
    {{--checking for notifications--}}
    @if(isset($notification))
        <script type="text/javascript">
            $(document).ready(function () {
                $('#notificationModal').find('#notificationContent').html('<h4 class="agileinfo_sign">{{ $message }}</h4>');
                $('#notificationModal').modal('show');
            });
        </script>
    @endif
    {{--checking for session flash messages--}}
    @if(session('message'))
        <script type="text/javascript">
            $(document).ready(function () {
                $('#notificationModal').find('#notificationContent').html('<h4 class="agileinfo_sign">{{ session('message') }}</h4>');
                $('#notificationModal').modal('show');
            });
        </script>
    @endif

@endsection


@extends('layouts.front')

@section('content')
    <h1>blablatruc</h1>
@endsection


@section('scripts')
    @parent
    {{--checking for errors--}}
    @if($errors->any())
        <script type="text/javascript">
            $(document).ready(function () {
                let html="<ul>";
                @foreach($errors->all() as $err)
                    html+="<li><h4 class='agileinfo_sign'>{{ $err }}</h4></li>";
                @endforeach
                    html+='</ul>';
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


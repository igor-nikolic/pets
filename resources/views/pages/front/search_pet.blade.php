@extends('layouts.front')
@section('content')
    <!-- single -->
    <div class="single welcome">
        <div class="container">
            <div class="col-md-4">
                <label for="searchPet">Pet name</label>
                <input type="text" name="searchPet" id="searchPet"/>
                <button type="button" class="btn btn-info" id="btnSearchPet">Search</button>

            </div>
            <div class="col-md-8" id="searchResult">
                @isset($pets)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                                <th>Father</th>
                                <th>Mother</th>
                                <th>Owner</th>
                                <th>Breed</th>
                            </tr>
                            </thead>
                            <tbody id="results">
                            @include('components.front.pet_pagination')
                            </tbody>
                        </table>
                        <input type="hidden" id="currentPage" value="1"/>
                        <input type="hidden" id="searchTerm" value=""/>
                @endisset
            </div>
        </div>
    </div>
    <!-- //single -->
@endsection
@section('scripts')
    @parent
    <script src="{{asset('/')}}js/select2/select2.full.js"></script>
    <script>
        $(document).ready(function () {
            $("#carouselExampleControls").carousel();

            $(document).on('click','#btnSearchPet',function () {
                let searchTerm = $('#searchPet').val().trim();
                $('#searchTerm').val(searchTerm);
                let page = $('#currentPage').val();
                searchPet(searchTerm,page);
            });

            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                $('#currentPage').val(page);

                let query = $('#searchTerm').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                searchPet(query,page);
            });

            function searchPet(query='',page=1){
                $.ajax({
                    url:baseURL+'/pets/search?q='+query+'&page='+page,
                    data:{
                        '_token':csrf
                    },
                    success:function (data) {
                        console.log(data);
                        $('#results').html('');
                        $('#results').html(data);
                    },
                    error:function () {
                        console.log("erorrs");
                    },
                    fail:function () {
                        console.log("failed");
                    }
                });
            }
        });
    </script>
@endsection
@section('styles')
    @parent
    <link href="{{ asset('/') }}css/select2/select2.min.css" rel='stylesheet' type='text/css' />
@endsection
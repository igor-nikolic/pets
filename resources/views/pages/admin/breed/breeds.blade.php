@extends('layouts.admin')
@section('content')

    @component('components.admin.page-name',[
    'pageName'=>'Breeds'])
    @endcomponent
    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="example1_filter" class="dataTables_filter"><label>Search by breed name:<input type="text"
                                                                                                                                             class="form-control input-sm"
                                                                                                                                             placeholder=""
                                                                                                                                             aria-controls="example1" id="searchBreed"></label>
                                <button type="button" id="btnSearchBreed">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @isset($breeds)
                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                       aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th>Breed id</th>
                                        <th>Breed</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody id="results">
                                    @include('partials.admin.breed_pagination')
                                    </tbody>
                                </table>
                                <input type="hidden" id="currentPage" value="1"/>
                                <input type="hidden" id="searchTerm" value=""/>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            // $("#carouselExampleControls").carousel();

            $(document).on('click','#btnSearchBreed',function () {
                let searchTerm = $('#searchBreed').val().trim();
                $('#searchTerm').val(searchTerm);
                // let page = $('#currentPage').val();
                searchBreed(searchTerm);
            });

            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                $('#currentPage').val(page);

                let query = $('#searchTerm').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                searchBreed(query,page);
            });

            function searchBreed(query='',page=1){
                $.ajax({
                    url:baseURL+'/admin/breed/search?q='+query+'&page='+page,
                    data:{
                        '_token':csrf
                    },
                    beforeSend:function(){
                        let btn = $('#btnSearchBreed');
                        btn.attr('disabled',true);
                        btn.addClass('disabled');
                        btn.html('Wait...');
                    },
                    success:function (data) {
                        let btn = $('#btnSearchBreed');
                        btn.attr('disabled',false);
                        btn.removeClass('disabled');
                        btn.html('Search');
                        $('#results').html('');
                        $('#results').html(data);
                    },
                    error:function () {
                        let btn = $('#btnSearchBreed');
                        btn.attr('disabled',false);
                        btn.removeClass('disabled');
                        btn.html('Search');
                        console.log("erorrs");
                    },
                    fail:function () {
                        let btn = $('#btnSearchBreed');
                        btn.attr('disabled',false);
                        btn.removeClass('disabled');
                        btn.html('Search');
                        console.log("failed");
                    }
                });
            }
        });
    </script>
@endsection
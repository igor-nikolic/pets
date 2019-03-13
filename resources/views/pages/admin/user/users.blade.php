@extends('layouts.admin')
@section('content')

    @component('components.admin.page-name',[
    'pageName'=>'Users'])
    @endcomponent
    <!-- Main content -->
    <section class="content">

        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="example1_filter" class="dataTables_filter"><label>Search by first name, last name, email or role:<input type="text"
                                                                                                     class="form-control input-sm"
                                                                                                     placeholder=""
                                                                                                     aria-controls="example1" id="searchUser"></label>
                                <button type="button" id="btnSearchUsers">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            @isset($users)
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th>User id</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created at</th>
                                    <th>Deleted at</th>
                                    <th>Activated at</th>
                                    <th>Updated at</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody id="results">
                                @include('partials.admin.user_pagination')
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

            $(document).on('click','#btnSearchUsers',function () {
                let searchTerm = $('#searchUser').val().trim();
                $('#searchTerm').val(searchTerm);
                // let page = $('#currentPage').val();
                searchUser(searchTerm);
            });

            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                $('#currentPage').val(page);

                let query = $('#searchTerm').val();

                $('li').removeClass('active');
                $(this).parent().addClass('active');
                searchUser(query,page);
            });

            function searchUser(query='',page=1){
                $.ajax({
                    url:baseURL+'/admin/user/search?q='+query+'&page='+page,
                    data:{
                        '_token':csrf
                    },
                    success:function (data) {
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
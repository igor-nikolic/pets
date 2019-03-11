@extends('layouts.front')
@section('content')
    <!-- single -->
    <div class="single welcome">
        <div class="container">
            {{--<h3 class="agileits-title">Pet info</h3>--}}
            <div class="markets-grids">
                <div class="col-md-7 w3ls_single_left">
                    <div class="w3ls_single_left_grid1">
                        @isset($photos)
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="3000">
                                <div class="carousel-inner col-md-6">
                                    @foreach($photos as $photo)
                                    <div class="{{ ($loop->first) ? 'item active' : 'item' }}">
                                        <img class="d-block" style="height: 400px;width: 100%" src="{{ asset('/images/pets') }}/{{ $photo->path }}" alt="{{$photo->alt}}">
                                    </div>
                                        @endforeach
                                </div>
                            </div>
                        @endisset
                        @isset($petData)
                            <h3>Pet info: </h3>
                            <h4><strong>Name: </strong>{{ ucfirst($petData->pet_name) }}</h4>
                            <h4><strong>Gender: </strong>{{ ($petData->gender == 'm') ? 'Male' : 'Female' }}</h4>
                            <h4><strong>Birthday: </strong>{{ $petData->birthday }}</h4>
                            <h4><strong>Breed: </strong>{{ $petData->breed_name }}</h4><br/>
                            @isset($fatherData)
                                    <h3>Father info: </h3>
                                    <h4><strong>Name: </strong>{{ ucfirst($fatherData->name) }}</h4>
                                    <h4><strong>Birthday: </strong>{{ $fatherData->birthday }}</h4><br/>
                                    {{--<h4><strong>Father breed: </strong>{{ $petData->breed_name }}</h4>--}}
                            @endisset
                            @isset($motherData)
                                    <h3>Mother info: </h3>
                                    <h4><strong>Name: </strong>{{ ucfirst($motherData->name) }}</h4>
                                    <h4><strong>Birthday: </strong>{{ $motherData->birthday }}</h4>
                            @endisset
                            @if(session()->has('user'))
                                @if(session()->get('user')->user_id === $petData->user_id)
                                    <a href="{{ url('/') }}/pets/{{ $petData->pet_id }}/edit"><button type="button" class="btn btn-info">Edit</button></a>
                                @endif
                            @endif
                        @endisset

                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="w3ls_single_left_grid">
                        <div class="w3ls_single_left_grid_right">
                            @isset($ownerData)
                                    <h3>Owner info: </h3>
                                <ul>
                                    <li><span class="fa fa-user" aria-hidden="true"></span>{{ $ownerData->first_name}} {{ $ownerData->last_name}}</li>
                                    <li><span class="fa fa-envelope-o" aria-hidden="true"></span><a href="mailto:{{ $ownerData->email }}?Subject=Mail%20for%20dog">{{ $ownerData->email }}</a></li>
                                    {{--<li><span class="fa fa-heart-o" aria-hidden="true"></span><a href="#">50 Likes</a></li>--}}
                                    {{--<li><span class="fa fa-tag" aria-hidden="true"></span><a href="#">3 Tags</a></li>--}}
                                </ul>
                            @endisset
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                {{--<div class="col-md-5 w3ls_single_right">--}}
                    {{--<div class="wthree_recent">--}}
                        {{--<h4>Recent Posts</h4>--}}
                        {{--<ul>--}}
                            {{--<li><a href="#"><i class="fa fa-check" aria-hidden="true"></i>tempora incidunt ut labore dolore</a><span><i class="fa fa-calendar" aria-hidden="true"></i> June 21, 2017.</span></li>--}}
                            {{--<li><a href="#"><i class="fa fa-check" aria-hidden="true"></i>voluptatem quia voluptas sit</a><span><i class="fa fa-calendar" aria-hidden="true"></i> June 23, 2017.</span></li>--}}
                            {{--<li><a href="#"><i class="fa fa-check" aria-hidden="true"></i>sed quia consequuntur magni</a><span><i class="fa fa-calendar" aria-hidden="true"></i> June 24, 2017.</span></li>--}}
                            {{--<li><a href="#"><i class="fa fa-check" aria-hidden="true"></i>ratione voluptatem sequi nesciunt</a><span><i class="fa fa-calendar" aria-hidden="true"></i> June 25, 2017.</span></li>--}}
                            {{--<li><a href="#"><i class="fa fa-check" aria-hidden="true"></i>aspernatur aut odit aut fugit</a><span><i class="fa fa-calendar" aria-hidden="true"></i> June 28, 2017.</span></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="clearfix"> </div>
            </div>
            {{--<div class="agile_tags_cate">--}}
                {{--<div class="col-md-4 agile_cat_grid">--}}
                    {{--<h4>Categories</h4>--}}
                    {{--<ul class="categories">--}}
                        {{--<li><a href="#">Donec rutrum malesuada curabitur</a></li>--}}
                        {{--<li><a href="#">Sed porttitorlactus nibh</a></li>--}}
                        {{--<li><a href="#">Curabitur aliquet quam id dui posuere blandit</a></li>--}}
                        {{--<li><a href="#">Nulla porttitoraccumsan tincidunt</a></li>--}}
                        {{--<li><a href="#">Mauris ac ullamcorper velit etiam quam</a></li>--}}
                        {{--<li><a href="#">Sed porttitorlactus nibh</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="col-md-4 agile_cat_grid">--}}
                    {{--<h4>Archives</h4>--}}
                    {{--<ul class="categories">--}}
                        {{--<li><a href="#">Jan 24,2014</a></li>--}}
                        {{--<li><a href="#">April 15,2014</a></li>--}}
                        {{--<li><a href="#">Sep 19,2015</a></li>--}}
                        {{--<li><a href="#">May 24,2015</a></li>--}}
                        {{--<li><a href="#">April 15,2017</a></li>--}}
                        {{--<li><a href="#">Jan 21,2017</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="col-md-4 agile_cat_grid">--}}
                    {{--<h4>Tags</h4>--}}
                    {{--<div class="agile_cat_grid_tags">--}}
                        {{--<ul>--}}
                            {{--<li><a href="#">Consectetur</a></li>--}}
                            {{--<li><a href="#">Adipisci</a></li>--}}
                            {{--<li><a href="#">Voluptatem</a></li>--}}
                            {{--<li><a href="#">Eius</a></li>--}}
                            {{--<li><a href="#">Lorem ipsum</a></li>--}}
                            {{--<li><a href="#">Adipisci</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="clearfix"> </div>--}}
            {{--</div>--}}
            {{--<div class="agileits_three_comments">--}}
                {{--<h3>3 Comments</h3>--}}
                {{--<div class="agileits_three_comment_grid">--}}
                    {{--<div class="agileits_tom">--}}
                        {{--<i class="fa fa-user"></i>--}}
                    {{--</div>--}}
                    {{--<div class="agileits_tom_right">--}}
                        {{--<div class="hardy">--}}
                            {{--<h4>Frank Lii</h4>--}}
                            {{--<p>21 June 2017</p>--}}
                        {{--</div>--}}
                        {{--<div class="reply">--}}
                            {{--<a href="#">Reply</a>--}}
                        {{--</div>--}}
                        {{--<div class="clearfix"> </div>--}}
                        {{--<p class="lorem">Etiam interdum non dui dignissim vestibulum. In non velit et mi varius bibendum eu sit amet ante. Morbi ullamcorper--}}
                            {{--nibh non dui volutpat volutpat. Pellentesque et porta urna.</p>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"> </div>--}}
                {{--</div>--}}
                {{--<div class="agileits_three_comment_grid agileits_three_comment_grid1">--}}
                    {{--<div class="agileits_tom">--}}
                        {{--<i class="fa fa-user" aria-hidden="true"></i>--}}
                    {{--</div>--}}
                    {{--<div class="agileits_tom_right">--}}
                        {{--<div class="hardy">--}}
                            {{--<h4>Richard Carl</h4>--}}
                            {{--<p>05 June 2017</p>--}}
                        {{--</div>--}}
                        {{--<div class="reply">--}}
                            {{--<a href="#">Reply</a>--}}
                        {{--</div>--}}
                        {{--<div class="clearfix"> </div>--}}
                        {{--<p class="lorem">Interdum etiam non dui dignissim vestibulum. In non velit et mi varius bibendum eu sit amet ante. Morbi ullamcorper--}}
                            {{--pellentesque et porta urna.</p>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"> </div>--}}
                {{--</div>--}}
                {{--<div class="agileits_three_comment_grid">--}}
                    {{--<div class="agileits_tom">--}}
                        {{--<i class="fa fa-user" aria-hidden="true"></i>--}}
                    {{--</div>--}}
                    {{--<div class="agileits_tom_right">--}}
                        {{--<div class="hardy">--}}
                            {{--<h4>Tom Hardy</h4>--}}
                            {{--<p>18 May 2017</p>--}}
                        {{--</div>--}}
                        {{--<div class="reply">--}}
                            {{--<a href="#">Reply</a>--}}
                        {{--</div>--}}
                        {{--<div class="clearfix"> </div>--}}
                        {{--<p class="lorem">Etiam interdum non dui dignissim vestibulum. In non velit et mi varius bibendum eu sit amet ante. Morbi ullamcorper--}}
                            {{--nibh non dui volutpat volutpat. Pellentesque et porta urna.</p>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"> </div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="w3_leave_comment">--}}
                {{--<h3>Leave your <span>comment</span></h3>--}}
                {{--<form action="#" method="post">--}}
                    {{--<input type="text" name="Name" placeholder="Name" required="">--}}
                    {{--<input class="email" type="email" name="Email" placeholder="Email" required="">--}}
                    {{--<input type="text" name="Phone" placeholder="Phone" required="">--}}
                    {{--<textarea placeholder="Message" name="Message" required=""></textarea>--}}
                    {{--<input type="submit" value="SUBMIT">--}}
                {{--</form>--}}
            {{--</div>--}}
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
        });
    </script>
@endsection
@section('styles')
    @parent
    <link href="{{ asset('/') }}css/select2/select2.min.css" rel='stylesheet' type='text/css' />
@endsection
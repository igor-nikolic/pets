@extends('layouts.front')
@section('content')
    <!-- single -->
    <div class="single welcome">
        <div class="container">
            {{--<h3 class="agileits-title">Pet info</h3>--}}
            <div class="markets-grids">
                <div class="col-md-6 col-lg-6">
                    <h2>Rate our website</h2>
                    <form id="pollForm" method="post">
                        @csrf
                        <div class="radio">
                            <label>
                                <input type="radio" name="poll[]" id="poll5" value="5" checked>
                                5
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="poll[]" id="poll4" value="4">
                                4
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="poll[]" id=poll3" value="3">
                                3
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="poll[]" id="poll2" value="2">
                                2
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="poll[]" id="poll1" value="1">
                                1
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default" id="btnSubmitPoll">Vote</button>
                    </form>
                    <div class="col-md-6 col-lg-6" id="pollResult">
                        <h2>Poll results</h2>
                        @isset($pollData)
                            @foreach($pollData["votes"] as $key=>$poll)
                                Number of votes for {{ $key  }} | <strong id="voteResult{{ $key  }}">{{ $poll }}</strong>  <br/>
                            @endforeach
                        @endisset
                        Total number of votes: <strong id="numberOfAllVotes">{{ $pollData["numberOfAllVotes"] }}</strong>
                    </div>
                    <div class="col-md-6 col-lg-6" id="pollNotification"></div>

                </div>
                <div class="col-md-6 col-lg-6">
                    <h2>Contact admin </h2>
                    <form id="formSendEmail" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="userEmail">Enter your email that you use on this application <small>(if you are registered)</small></label>
                            <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Your email">
                        </div>
                        <label for="selectProblem">Select your problem</label>
                        <select class="form-control" id="selectProblem" name="selectProblem">
                            <option value="User problem with login">Problem with login</option>
                            <option value="Deactivate account">Deactivate account</option>
                            <option value="Account reactivation">Account reactivation</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="form-group">
                            <label for="problemDescription">Describe your problem</label>
                            <textarea style="resize:none;" maxlength="300" class="form-control" id="problemDescription" name="problemDescription" rows="5"></textarea>
                        </div>
                        <button type="submit" id="btnSendMail" class="btn btn-default">Send email</button>
                    </form>
                </div>
                <div class="col-md-6 col-lg-6" id="emailNotification"></div>
                <div class="clearfix"> </div>
            </div>

        </div>
    </div>
    <!-- //single -->
@endsection
@section('scripts')
    @parent
    {{--<script src="{{asset('/')}}js/select2/select2.full.js"></script>--}}
    <script>
        $(document).ready(function () {
            $(document).on('submit','#pollForm',function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                $.ajax({
                    type:'POST',
                    url:baseURL+'/vote',
                    data:fd,
                    processData: false,
                    contentType: false,
                    beforeSend:function(){
                        $('#btnSubmitPoll').html('Wait ...');
                        $('#btnSubmitPoll').addClass('disabled');
                        $('#btnSubmitPoll').attr('disabled',true);
                    },
                    success:function(data) {
                        console.log(data);
                        data = JSON.parse(data);
                        if(data.success){
                            $('#btnSubmitPoll').html('Voted!');
                            $('#pollNotification').html(`<div class="alert alert-dismissible alert-success" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                            let votedFor = data.votedFor;
                            let voteString = '#voteResult'+votedFor;
                            $(voteString).html(parseInt($(voteString).html())+1);
                            $('#numberOfAllVotes').html(parseInt($('#numberOfAllVotes').html())+1);
                        }else{
                            $('#btnSubmitPoll').html('Submit');
                            $('#btnSubmitPoll').removeClass('disabled');
                            $('#btnSubmitPoll').removeAttr('disabled');
                            $('#pollNotification').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notification">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        }
                    },
                    fail:function (xhr, status, errorMsg) {
                        $('#btnSubmitPoll').html('Submit');
                        $('#btnSubmitPoll').removeClass('disabled');
                        $('#btnSubmitPoll').removeAttr('disabled');


                    },
                    error:function (xhr, status, errorMsg) {
                        $('#btnSubmitPoll').html('Submit');
                        $('#btnSubmitPoll').removeClass('disabled');
                        $('#btnSubmitPoll').removeAttr('disabled');
                    }
                });
            });
            $(document).on('submit','#formSendEmail',function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                $.ajax({
                    type:'POST',
                    url:baseURL+'/email',
                    data:fd,
                    processData: false,
                    contentType: false,
                    beforeSend:function(){
                        $('#btnSendMail').html('Sending ...');
                        $('#btnSendMail').addClass('disabled');
                        $('#btnSendMail').attr('disabled',true);
                    },
                    success:function(data) {
                        data = JSON.parse(data);
                        if(data.success){
                            $('#btnSendMail').html('Send mail!');
                            $('#btnSendMail').removeClass('disabled');
                            $('#btnSendMail').removeAttr('disabled');
                            $('#emailNotification').html(`<div class="alert alert-dismissible alert-success" role="alert" id="notificationEmail">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                            document.querySelector('#formSendEmail').reset();
                        }else{
                            $('#btnSendMail').html('Submit');
                            $('#btnSendMail').removeClass('disabled');
                            $('#btnSendMail').removeAttr('disabled');
                            $('#emailNotification').html(`<div class="alert alert-dismissible alert-danger" role="alert" id="notificationEmail">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>${data.message}</div>`);
                        }
                    },
                    fail:function (xhr, status, errorMsg) {
                        $('#btnSendMail').html('Submit');
                        $('#btnSendMail').removeClass('disabled');
                        $('#btnSendMail').removeAttr('disabled');


                    },
                    error:function (xhr, status, errorMsg) {
                        $('#btnSendMail').html('Submit');
                        $('#btnSendMail').removeClass('disabled');
                        $('#btnSendMail').removeAttr('disabled');
                    }
                });
            });
            // $("#carouselExampleControls").carousel();
        });
    </script>
@endsection
@section('styles')
    @parent
    {{--<link href="{{ asset('/') }}css/select2/select2.min.css" rel='stylesheet' type='text/css' />--}}
@endsection
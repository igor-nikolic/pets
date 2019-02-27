<div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <div class="signin-form profile">
                @if(session()->has('user'))
                        <h3 class="agileinfo_sign">You are logged in!</h3>
                @else
                        <h3 class="agileinfo_sign">Sign In</h3>
                        <div class="login-form">
                            <form action="/login" method="post">
                                @csrf
                                <input type="email" name="loginemail" placeholder="E-mail" required="">
                                <input type="password" name="loginpassword" placeholder="Password" required="">
                                <div class="tp">
                                    <input type="submit" value="Sign In">
                                </div>
                            </form>
                        </div>
                        {{--<div class="login-social-grids">--}}
                            {{--<ul>--}}
                                {{--<li><a href="#"><i class="fa fa-facebook"></i></a></li>--}}
                                {{--<li><a href="#"><i class="fa fa-twitter"></i></a></li>--}}
                                {{--<li><a href="#"><i class="fa fa-rss"></i></a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        <p><a href="#" data-toggle="modal" data-target="#registerModal"> Don't have an account? Register here!</a></p>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
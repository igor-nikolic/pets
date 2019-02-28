<div class="modal fade" id="registerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <div class="signin-form profile">
                    @if(session()->has('user'))
                        <h3 class="agileinfo_sign">You are logged in!</h3>
                    @else
                        <h3 class="agileinfo_sign">Sign Up</h3>
                        <div class="login-form">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <input type="text" name="first_name" placeholder="First name">
                                <input type="text" name="last_name" placeholder="Last name" >
                                <input type="email" name="email" placeholder="Email" >
                                <input type="password" class="password" name="password" id="password" placeholder="Password"  />
                                <input type="password" class="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password"  />
                                <input type="submit" value="Sign Up" name="btnRegister">
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="top-nav w3-agiletop">
    <div class="agile_inner_nav_w3ls">
        <div class="navbar-header w3llogo">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1><a href="{{ url('/') }}">Pets Care</a></h1>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="w3menu navbar-left">
                <ul class="nav navbar">
                    @isset($menu)
                        @foreach($menu as $m)
                            @if(session()->has('user'))
                                @if(session()->get('user')->role_id == 1)
                                    <li><a href="{{ url($m->uri) }}" {{ ($loop->first) ? 'class="active"' : '' }}>{{ $m->name }}</a></li>
                                @else
                                    @if($m->role_id !== 1)
                                        <li><a href="{{ url($m->uri) }}" {{ ($loop->first) ? 'class="active"' : '' }}>{{ $m->name }}</a></li>
                                    @endif
                                @endif
                            @else
                                @if(is_null($m->role_id))
                                    <li><a href="{{ url($m->uri) }}" {{ ($loop->first) ? 'class="active"' : '' }}>{{ $m->name }}</a></li>
                                @endif
                            @endif
                        @endforeach
                    @endisset
                </ul>
            </div>
            <div class="w3ls-bnr-icons social-icon navbar-right">
                <a href="https://www.twitter.com" class="social-button twitter"><i class="fa fa-twitter"></i></a>
                <a href="https://www.facebook.com" class="social-button facebook"><i class="fa fa-facebook"></i></a>
                <a href="https://www.google.com" class="social-button google"><i class="fa fa-google-plus"></i></a>
                <a href="https://dribbble.com/" class="social-button dribbble"><i class="fa fa-dribbble"></i></a>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
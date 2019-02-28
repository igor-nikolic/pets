<div class="top-nav w3-agiletop">
    <div class="agile_inner_nav_w3ls">
        <div class="navbar-header w3llogo">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1><a href="index.html">Pets Care</a></h1>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="w3menu navbar-left">
                <ul class="nav navbar">
                    @isset($menu)
                        @foreach($menu as $m)
                            <li><a href="{{ $m->uri }}" {{ ($loop->first) ? 'class="active"' : '' }}>{{ $m->name }}</a></li>
                        @endforeach
                    @endisset

                    {{--<li><a href="{{ route('about') }}">About</a></li>--}}
                    {{--<li><a href="gallery.html">Gallery</a></li>--}}
                    {{--<li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span data-letters="Pages">Pages</span><span class="caret"></span></a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li><a href="icons.html">Icons</a></li>--}}
                            {{--<li><a href="typo.html">Typography</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                </ul>
            </div>
            <div class="w3ls-bnr-icons social-icon navbar-right">
                <a href="#" class="social-button twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" class="social-button facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" class="social-button google"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="social-button dribbble"><i class="fa fa-dribbble"></i></a>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
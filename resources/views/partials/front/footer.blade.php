<div class="copy-w3right">
    <div class="container">
        <div class="top-nav bottom-w3lnav">
            <ul>
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
        <p>© 2017 Pets Care. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
    </div>
</div>
<div class="agileits-banner">
    <div class="bnr-agileinfo">
        <div class="banner-top w3layouts">
            <div class="container">
                <ul class="agile_top_section">
                    <li>
                        <p> @isset($company)
                                <a href="mailto:{{ $company->email }}?Subject=Mail%20from%20website">{{ $company->email }}</a>
                            @endisset
                        </p>
                    </li>
                    <li>
                        <p><span class="glyphicon glyphicon-earphone"></span>@isset($company)
                                                                                 {{ $company->phone }}
                        @endisset
                        </p>
                    </li>
                    @if(session()->has('user'))
                        <li><a class="sign" href="/signout"><i class="fa fa-sign-out"></i> Sign Out</a>							</li>
                    @else
                        <li><a class="sign" href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a>							</li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="banner-w3text w3layouts">
            <p class="w3_text">Inspired by w3layouts</p>
            <h3 class="w3ls_agile">Dog Cat Pet Care </h3>

            <h2>Pets Care</h2>
        </div>
        <!-- navigation -->
    @include('components.front.nav')
    <!-- //navigation -->
    </div>
</div>
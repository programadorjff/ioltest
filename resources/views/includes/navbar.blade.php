<!-- Fixed navbar -->
<nav class="navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ route('get_dashboard') }}">{!! trans('master.title') !!}</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{!! trans('navBar.lang') !!}<span
	                      class="caret"></span></a>
	            <ul class="dropdown-menu" role="menu">
			    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
			        <li>
			            <a hreflang="{!!$localeCode!!}" href="{!!LaravelLocalization::getLocalizedURL($localeCode) !!}">
			                {!! $properties['native'] !!}
			            </a>
			        </li>
			    @endforeach
	            </ul>
		    </li>
		</ul>
      @if (Auth::check())
        <ul class="nav navbar-nav">
          <li><a href="{{ route('get_dashboard') }}">{!! trans('navBar.dashboard') !!}</a></li>
          <li><a href="{{ route('get_briefings') }}">{!! trans('navBar.briefings') !!}</a></li>
          <li><a href="{{ route('get_budgets') }}">{!! trans('navBar.budgets') !!}</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{!! Auth::user()->email !!}<span
                      class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ route('show_profile', array('id' => Auth::user()->id)) }}">{!! trans('navBar.profile') !!}</a>
              </li>
              <li><a href="{{ route('get_settings') }}">{!! trans('navBar.settings') !!}</a></li>
              <li class="divider"></li>
              <li><a href="{{ route('get_logout') }}">{!! trans('navBar.signOut') !!}</a></li>
            </ul>
          </li>
        </ul>
      @endif
      {{--
      @if (!Auth::check())
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{ route('get_login') }}">{!! trans('navBar.signIn') !!}</a></li>
          <li><a href="{{ route('get_signup') }}">{!! trans('navBar.signUp') !!}</a></li>
        </ul>
      @endif
      --}}
    </div>
    <!--/.nav-collapse -->
  </div>
</nav>
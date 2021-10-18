


<div class="top-header">
    <div class="container">

            <div class="dropdown float-right">
                @if (Auth::check())
                    <a class="dropdown-toggle pointer top-header-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> {{ Auth::user()->name }}
                    </a>
                @else
                    <a class="dropdown-toggle pointer top-header-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>My Account
                    </a>
                @endif


                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if (Auth::check())
                        <a class="dropdown-item" href="{{ route('user.show',Auth::user()->username) }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a class="dropdown-item" href="{{ route('login') }}">Sign In</a>
                        <a class="dropdown-item" href="{{ route('register') }}">Sign Up</a>
                    @endif
                </div>

            </div>


      <div class="float-right">
        <a href="" class="top-header-link"><span class="item">10</span> items in wishlist</a>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>


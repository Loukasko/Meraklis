<style>
    .navbar {
        background-color: #43240E;
        -webkit-box-shadow: none;
        box-shadow: none;
        border-color: #43240E;
        opacity: 0.8;
        filter:(opacity=50);
    }
    .nav.navbar-nav.navbar-right li a {
        color: #F6E0C4 !important;
        font-size: 1.1em !important;
    }
    .navbar-brand {
        color: #F6E0C4 !important;
    }
    .dropdown-toggle {
       background-color: transparent !important;
    }

    .dropdown-menu {
        text-align: center;
        background-color: #43240E !important;
    }

    .dropdown-menu li a {
        background-color: transparent !important;
    }

    .container-fluid {
        margin-left: 15px;
        margin-right: 15px;
    }

    #badge{
        color : #43240E;
        background-color: #F6E0C4;
    }

</style>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"  href="/">ΜΕΡΑΚΛΗΣ</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                <li>
                    <a href="{{ route('shop.shopping-cart') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> SHOPPING CART
                        <span id="badge" class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
                    </a>
                </li>
                @endif
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> USER MANAGMENT <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(Auth::check())
                            <li><a class="dropdown-item" href="{{route('shop.index')}}">COFFEE and SNACKS</a></li>
                            <li role="separator" class="divider"></li>
                            {{--<li><a href="{{route('logout')}}">Logout</a></li>--}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('LOGOUT') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li><a href="{{route('register')}}">Signup</a></li>
                            <li><a href="{{route('login')}}">Signin</a></li>
                        @endif

                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
 <header id="header">{{--Header--}}
    <div class="header_top">{{-- Header superior --}}
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="tel:+569 82715733"><i class="fa fa-phone"></i> +569 82715733</a></li>
                            <li><a href="mailto:empleo@gabrielflores.cl"><i class="fa fa-envelope"></i> empleo@gabrielflores.cl</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="https://twitter.com/gfloresm91"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/gabrielfloresmonsalve"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="https://github.com/gflores91"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>{{-- ./Header superior --}}
    
    <div class="header-middle">{{-- Header medio --}}
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="logo pull-left">
                        <a href="{{ route('product.index') }}"><img src="{{ asset('images/home/logo.png') }}" alt="Inicio" title="inicio" /></a>
                    </div>
                    <div class="btn-group pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                Cambiar moneda
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">CLP</a></li>
                                <li><a href="#">USD</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            
                            <li><a href="#"><i class="fa fa-star"></i> Lista de deseos</a></li>
                            <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li>
                                <a href="{{route('product.carro')}}">
                                    <i class="fa fa-shopping-cart"></i> 
                                    Carro <span class="badge">
                                        {{Session::has('cart') ? Session::get('cart')->totalCantidad : '0'}}
                                    </span>
                                </a>
                            </li>
                            @if(Auth::check())
                                <li class="dropdown">
                                    <a href="#!" class="dropdown-toggle">
                                        <span class="glyphicon glyphicon-user"></span>
                                        <strong>{!! Auth::user()->name !!}</strong>
                                        <span class="glyphicon glyphicon-chevron-down"></span>
                                    </a>
                                    <ul class="dropdown-menu user-dropdown">
                                        <li>
                                            <div class="navbar-login">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p class="text-center">
                                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <p class="text-left"><strong>{Nombre completo}</strong></p>
                                                        <p class="text-left small">{!! Auth::user()->email !!}</p>
                                                        <p class="text-left">
                                                            <a href="{{route('user.perfil')}}" class="btn btn-info btn-block">Perfil</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                       
                                        <li class=" usermenu">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="#">Configuración de la cuenta <span class="glyphicon glyphicon-cog pull-right"></span></a>
                                                </div>
                                            </div>
                                             <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="#">Notificaciones <span class="badge pull-right">42</span></a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <a href="#">Historial <span class="glyphicon glyphicon-th-list pull-right"></span></a>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="row btnlogout">
                                                <div class="col-lg-12">
                                                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-block">Cerrar sesión <span class="glyphicon glyphicon-log-out"></span></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                               
                            @else
                                <li><a href="{{ route('user.login') }}"><i class="fa fa-lock"></i> Iniciar sesión</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>{{-- ./Header medio --}}

    <div class="header-bottom">{{-- Header inferior --}}
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ route('product.index') }}" class="{{URL::current() == URL::route('product.index') ? 'active' : ''}}">Inicio</a></li>
                            <li><a href="{{ route('product.productos') }}" class="{{URL::current() == URL::route('product.productos') ? 'active' : ''}}">Productos</a></li>
                            {{--
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li> 
                                    <li><a href="checkout.html">Checkout</a></li> 
                                    <li><a href="cart.html">Cart</a></li> 
                                    <li><a href="login.html">Login</a></li> 
                                </ul>
                            </li> 
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li> 
                            <li><a href="404.html">404</a></li>
                            <li><a href="contact-us.html">Contact</a></li>
                            --}}
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Buscar"/>
                    </div>
                </div>
            </div>
        </div>
    </div>{{-- ./Header inferior --}}
</header>{{-- ./Header --}}
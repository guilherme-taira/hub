<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Lookas Embaleme</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css"
        rel="stylesheet" />
    <!-- Google fonts-->

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
        rel="stylesheet" type="text/css" />

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- AJAX --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" type="text/css" />

    <!--WIDGET UI -->
    <link href="{{ asset('/css/widget.css') }}" rel="stylesheet" type="text/css" />



</head>

<body id="page-top">
    <!-- Navigation-->
    <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand"><a href="{{ route('admin.home') }}">Gerenciador - Embaleme</a></li>
            <li class="sidebar-nav-item"><a href="{{ route('product.index') }}">Look.as Produtos</a></li>
            <li class="sidebar-nav-item"><a href="{{ route('trayproduct.index') }}">Tray Produtos &nbsp; <img src="{{asset('assets/img/logos/tray.svg')}}" style="width: 24px; height: 24px;"></a></li>
            <li class="sidebar-nav-item"><a href="{{ route('Uello.index') }}">Uello  &nbsp; <img src="{{asset('assets/img/logos/uello.jpg')}}" style="width: 24px; height: 24px;"></a></li>
            <li class="sidebar-nav-item"><a href="{{ route('Pedidos.index') }}">Pedidos Bling  &nbsp; <img src="{{asset('assets/img/logos/bling.svg')}}" style="width: 24px; height: 24px;"></a></li>
            <li class="sidebar-nav-item"><a href="{{ route('brindes.index') }}">Brinde <img src="{{asset('assets/img/logos/gift.svg')}}" style="width: 24px; height: 24px;"></a></li>
            <li class="sidebar-nav-item"><a href="{{ route('Shopee.index')}}">Shopee</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Mercado Livre &nbsp; <img src="{{asset('assets/img/logos/mercadolivre.svg')}}" style="width: 24px; height: 24px;"></a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item text-primary" href="{{route('Categories.index')}}">Categorias Especiais</a></li>
                  <li><a class="dropdown-item text-primary" href="{{ route('mercadolivre.index') }}">Mercado Livre</a></li>
                  <li><a class="dropdown-item text-primary" href="{{ route('hubmercadolivre') }}">Hub Mercado Livre <div
                              class="spinner-border spinner-border-sm" role="status">
                              <span class="visually-hidden">Loading...</span>
                          </div></a></li>
                </ul>
              </li>
           
        </ul>
    </nav>
    <!--- content ----->
    @yield('conteudo')
    <!--- end content -->

    <!-- Footer-->
    <footer class="footer mt-4 text-center">
        <div class="container px-4 px-lg-5">
            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!"><i
                            class="icon-social-facebook"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white mr-3" href="#!"><i
                            class="icon-social-twitter"></i></a>
                </li>
                <li class="list-inline-item">
                    <a class="social-link rounded-circle text-white" href="#!"><i class="icon-social-github"></i></a>
                </li>
            </ul>
            <p class="text-muted small mb-0">Copyright &copy; Embaleme APP {{ date('Y') }}</p>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('/js/scripts.js') }}"></script>
</body>

</html>

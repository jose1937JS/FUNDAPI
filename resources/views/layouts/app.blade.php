<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ asset('css/mdb-4.8.8.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/fontawesome/css/all.min.css') }}" rel="stylesheet">

	<style>
		html, body {
			height: 100%;
			background-color: #f5f5f5;
		}

		.fondo-login {
			background-image: url({{ asset('img/fondologin.jpg') }});
			background-attachment: fixed;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}

		.fixed-sn main {
			padding-top: 3%;
			margin-left: 20% !important;
			margin-right: 1% !important;
		}

		@media(max-width: 1024px){
			.fixed-sn main {
				margin: 0% !important;
			}
		}

		.sn-bg-4 {
			background-image: url({{ asset('img/sidenav4.jpg') }});
		}

		.side-nav .sidenav-bg.mask-strong:after,
		.side-nav .sidenav-bg:after {
			background:rgba(0,0,0,.8)
		}

		.page-footer {
			position: absolute;
			width: 100%;
			bottom: 0;
		}

		.collapsible-header .active {

		}
	</style>
</head>
<body class="fixed-sn">

	@auth
		<nav class="navbar navbar-expand-md navbar-dark elegant-color shadow-sm">
			<!-- SideNav slide-out hidden button -->
			<a href="#" data-activates="slide-out" class="btn btn-dark p-3 button-collapse"></a>
			<div class="container" style="margin-left: 15%">
				<a class="navbar-brand" href="{{ url('/') }}">
					{{ config('app.name', 'Laravel') }}
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto" style="margin-left: 2%">
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">

						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									{{ __('Salir') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Sidebar navigation -->
		<div id="slide-out" class="side-nav sn-bg-4 fixed ">
			<ul class="custom-scrollbar">
				<!-- Logo -->
				<li>
					<div class="logo-wrapper waves-light">
						<a href="#"><img src="{{ asset('img/mdb-transparent.png') }}" class="img-fluid flex-center"></a>
					</div>
				</li>
				<!--/. Logo -->
				<!--Social-->

				<!--/Social-->
				<!-- Side navigation links -->
				<li>
					<ul class="collapsible collapsible-accordion ">
						<li>{{--
							<a id="products" class="collapsible-header waves-effect" href="{{ route('products.index') }}">
								<i class="fas fa-coins"></i> Productos
							</a>
						</li> --}}
						<li>
							<a id="doctors" class="collapsible-header waves-effect" href="{{ route('doctors.index') }}">
								<i class="fas fa-user-md"></i> Doctores
							</a>
						</li>
						<li>
							<a id="services" class="collapsible-header waves-effect" href="{{ route('services.index') }}">
								<i class="fas fa-clipboard-list"></i> Servicios
							</a>
						</li>
						<li>
							<a id="specialties" class="collapsible-header waves-effect" href="{{ route('specialties.index') }}">
								<i class="fas fa-list-ol"></i> Especialidades
							</a>
						</li>
						<li>
							<a id="enterprise" class="collapsible-header waves-effect" href="{{ route('enterprise.index') }}">
								<i class="fas fa-clinic-medical"></i> About Us
							</a>
						</li>
					</ul>
				</li>
				<!--/. Side navigation links -->
			</ul>

			<!--<footer class="page-footer font-small text-center elegant-color py-2">
				<p>Desarrollado por José López 2019 - 2020</p>
				<div class="footer-copyright d-flex justify-content-center" style="height: 40px">
					<a href="https://github.com/jose1937JS/"><i class="fab fa-github"></i></a>
					<a href="https://www.facebook.com/josefer20"><i class="fab fa-facebook"></i></a>
					<a href="https://t.me/josepher"><i class="fab fa-telegram"></i></a>
				</div>
			</footer>-->

			<div class="sidenav-bg mask-strong"></div>
		</div>
			<!--/. Sidebar navigation -->

	@endauth

	<!-- CONTENIDO DE LA PAGINA -->
	@yield('content')

	<!-- Scripts -->
	<script src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
	<script src="{{ asset('js/mdb.min.js') }}" ></script>
	<script src="{{ asset('js/app.js') }}" ></script>

	@stack('scripts')
</body>
</html>

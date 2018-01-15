<!doctype html>
<html lang="en">
<head>

	<!-- start header -->
		@include('admin.head')
	<!-- end header -->


</head>
<body>

<div class="wrapper">

		<!-- start sidebar -->

			@include('admin.sidebar')

		<!-- end sidebar -->

    <div class="main-panel">

				<!-- start navbar -->

				<nav class="navbar navbar-default navbar-fixed">
						<div class="container-fluid">
								<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
										</button>
										<a class="navbar-brand" href="#">Dashboard</a>
								</div>
								<div class="collapse navbar-collapse">
										<ul class="nav navbar-nav navbar-left">
												<li>
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																<i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
														</a>
												</li>
												<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																		<i class="fa fa-globe"></i>
																		<b class="caret hidden-lg hidden-md"></b>
									<p class="hidden-lg hidden-md">
										5 Notifications
										<b class="caret"></b>
									</p>
															</a>
															<ul class="dropdown-menu">
																<li><a href="#">Notification 1</a></li>
																<li><a href="#">Notification 2</a></li>
																<li><a href="#">Notification 3</a></li>
																<li><a href="#">Notification 4</a></li>
																<li><a href="#">Another notification</a></li>
															</ul>
												</li>
												<li>
													 <a href="">
																<i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
														</a>
												</li>
										</ul>

										<ul class="nav navbar-nav navbar-right">
												<li>
													 <a href="/quotes/create">
															 <p>Buat Quote</p>
														</a>
												</li>
												<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																		<p>
										{{ Auth::user()->name }}
										<b class="caret"></b>
									</p>

															</a>
															<ul class="dropdown-menu">
																<li>
																	<a href="/profile">Profile</a>
																</li>
																	<li>
																		<a href="/quotes">Beranda Kutipan</a>
																	</li>
																	<li>
																		<a href="/quotes/create">Buat Quotes</a>
																	</li>
																<li class="divider"></li>
																<li>
																		<a href="{{ route('logout') }}"
																				onclick="event.preventDefault();
																								 document.getElementById('logout-form').submit();">
																				Logout
																		</a>

																		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																				{{ csrf_field() }}
																		</form>
																</li>
															</ul>
												</li>
						<li class="separator hidden-lg"></li>
										</ul>
								</div>
						</div>
				</nav>


				<!-- end navbar -->


        <div class="content">
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>


        <!-- start footer -->

					@include('admin.footer')

				<!-- end footer -->

    </div>
</div>

</body>

    <!--   Core JS Files   -->
    <script src="{!! asset('assets/js/jquery.3.2.1.min.js') !!}" type="text/javascript"></script>
	<script src="{!! asset('assets/js/bootstrap.min.js') !!}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{!! asset('assets/js/chartist.min.js') !!}"></script>

    <!--  Notifications Plugin    -->
    <script src="{!! asset('assets/js/bootstrap-notify.js') !!}"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{!! asset('assets/js/light-bootstrap-dashboard.js?v=1.4.0') !!}"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{!! asset('assets/js/demo.js') !!}"></script>

	<!-- <script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script> -->

</html>

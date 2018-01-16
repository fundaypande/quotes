<!DOCTYPE HTML>
<!--
	Theory by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Quotes of The Day</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="{!! asset('css/main.css') !!}" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="/" class="logo">Quotes</a>
					<nav id="nav">
						@guest
								<a href="/quotes/create">Create Quotes</a>
								<a href="{{ route('login') }}">Login</a>
								<a href="{{ route('register') }}">Register</a>
						@else
								<a href="/quotes/create">Create Quotes</a>
								<a href="/profile" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
									{{ Auth::user()->name }} <span class="caret"></span>
								</a>
						@endguest
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Banner -->
			<section id="banner">
				<h1>Welcome to Quotes</h1>
				<p>A free Quotes Every Day - Every Time You Need</p>
			</section>

		<!-- One -->
			<section id="one" class="wrapper">
				<div class="inner">
					<div class="flex flex-3">
						@foreach($quotes-> all() as $quote)
							<article>
								<header>
									<h3>{{$quote -> title}}</h3>
								</header>
								<p>
									<?php
										$text = $quote -> subject;
										echo limit($text, 50);
									?>
								</p>
								<footer>
									<a href="/quotes/{{$quote -> slug}}" class="button special">More</a>
								</footer>
							</article>
							<br>
						@endforeach
					</div>
					<br>
					<br>
					<center>
						<a href="/quotes" class="button special">Tampilkan Lebih Banyak</a>
					</center>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style1 special">
				<div class="inner">
					<header>
						<h2>Daftar User</h2>
						<p>Beberapa User Yang Aktif</p>
					</header>
					<div class="flex flex-4">
						@foreach( $users -> all() as $user )
							<div class="box person">
								<div class="image round">
									<img src="images/pic06.jpg" alt="Person 1" />
								</div>
								<h3>{{ $user -> name }}</h3>
								<p>{{ $user -> email }}</p>
							</div>
						@endforeach
					</div>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<div class="flex">
						<div class="copyright">
							&copy; Untitled. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com">Unsplash</a>.
						</div>
						<ul class="icons">
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-linkedin"><span class="label">linkedIn</span></a></li>
							<li><a href="#" class="icon fa-pinterest-p"><span class="label">Pinterest</span></a></li>
							<li><a href="#" class="icon fa-vimeo"><span class="label">Vimeo</span></a></li>
						</ul>
					</div>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="{!! asset('js/jquery.min.js') !!}"></script>
			<script src="{!! asset('js/skel.min.js') !!}"></script>
			<script src="{!! asset('js/util.js') !!}"></script>
			<script src="{!! asset('js/main.js') !!}"></script>

	</body>
</html>

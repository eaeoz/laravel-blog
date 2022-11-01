<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
		integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<link rel="stylesheet" href="{{ asset('front') }}/style.css">

	<title>@yield('title',$config->title )</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset($config->favicon) }}">
</head>

<body>

	<nav class="navbar bg-dark navbar-expand-sm navbar-dark fixed-top">
		<div class="container">
			<a href="/" class="navbar-brand">
                @if($config->logo!=null)
                <img src="{{ asset($config->logo) }}" width="50">
                @else
			    {{ $config->title }}
                @endif
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div id="navbarCollapse" class="collapse navbar-collapse">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a href="/" class="nav-link active">
							Home
						</a>
					</li>
                    @foreach ($pages as $page)
                    <li class="nav-item">
						<a href="{{ route('page',$page->slug) }}" class="nav-link active">
							{{ $page->title }}
						</a>
					</li>
                    @endforeach
					<li class="nav-item">
						<a href="/contact" class="nav-link active">
							Contact
						</a>
					</li>
				</ul>
			</div>

		</div>
	</nav>

	<header>

		<div class="jumbotron text-white" style="background-image: url('@yield('image')'); background-size: 100%">
			<div class="container">
				<div class="col-md-6 px-0">
					<h1 class="display-4 font-italic">
						@yield('title')
					</h1>

				</div>
			</div>
		</div>


	</header>

	<main>

		<div class="container">
			<div class="row">

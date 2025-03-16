<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Ecommerce Store</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />


	<link rel="stylesheet" type="text/css" href="{{asset ('front-assets/css/slick.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{asset ('front-assets/css/slick-theme.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{asset ('front-assets/css/ion.rangeSlider.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{asset ('front-assets/css/style.css') }}" />

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{route('home')}}" />
	<meta name="csrf-token" content="{{csrf_token() }}">

</head>

<body data-instant-intensity="mousedown">

	<div class="bg-light top-header">
		<div class="container">
			<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
				<div class="col-lg-4 logo">
					<a href="{{route('home')}}" class="text-decoration-none">
						<span class="h1 text-uppercase text-primary px-2" style="font-family:'Bradley Hand', sans-serif;">Ecommerce</span>
						<span class="">Store</span>

						<!--<span class="h1 text-dark bg-primary px-2 ml-n1">Store</span>-->
					</a>
				</div>
			</div>
		</div>
	</div>

	<header class="bg-dark">
		<div class="container">
			<nav class="navbar navbar-expand-xl justify-content-center" id="navbar">
			<button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<!-- <span class="navbar-toggler-icon icon-menu"></span> -->
					<i class="navbar-toggler-icon fas fa-bars"></i>
				</button>


				<a href="{{route('home')}}" class="navbar-brand d-lg-none" href="{{route('home')}}">
					<span class="h2 text-uppercase text-primary bg-dark">Ecommerce</span>
					<span class="h2 text-uppercase text-white px-2">Store</span>
				</a>
	
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<!-- <li class="nav-item">
          				<a class="nav-link active" aria-current="page" href="index.php" title="Products">Home</a>
        			</li> -->
					
						<li class="nav-item dropdown">
							<a href="{{ route('home') }}"class="nav-link text-white">Home</a>
						</li>
						<li class="nav-item dropdown">
							<a href="{{ route('products.index') }}"class="nav-link text-white">Shop</a>
						</li>
						<li class="nav-item dropdown">
							<a href="#"class="nav-link text-white">About Us</a>
						</li>
						<li class="nav-item dropdown">
							<a href="#"class="nav-link text-white">Contact Us</a>
						</li>
						<li class="nav-item dropdown list-unstyled">
						@if(Auth::check())
							<a href="{{route('logout')}}" class="nav-link text-white">Logout</a>
						@endif
					</li>
					</ul>
				</div>
				<div class="py-0 my-2">
    <div class="d-flex gap-3 flex-wrap align-items-center">
        
        <!-- Search Form -->
        <form action="#" method="get" class="d-flex">
            <div class="input-group">
                <input 
                    value="{{ Request::get('search') }}" 
                    type="text" 
                    placeholder="Search" 
                    class="form-control" 
                    name="search" 
                    id="search"
                >
                <button type="submit" class="input-group-text">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>

        <!-- Shopping Cart Icon -->
        <a href="#" class="d-flex align-items-center text-decoration-none">
            <i class="fas fa-shopping-cart text-primary fs-5"></i>
        </a>

        <!-- User Account Dropdown -->
        

    </div>
</div>

			</nav>
		</div>
	</header>


	<main>
		@yield('content')
	</main>


	<footer class="bg-dark mt-5">
		<div class="container pb-5 pt-3">
			<div class="row">
				<div class="col-md-4">
					<div class="footer-card">
						<h3>Get In Touch</h3>
						<p>Email: Antonymilad199@gmail.com<br>
							Phone Number: 01223361511</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="footer-card">
						<h3>Links</h3>
						<ul>							
							<li><a href="#" title="about">About Us</a></li>
							<li><a href="#" title="contact">Contact Us</a></li>
						</ul>
					</div>

				</div>
				<div class="col-md-4">
					<div class="footer-card">
						<h3>My Account</h3>
						<ul>
							<li><a href="#" title="Contact Us">Profile</a></li>
							<li><a href="#" title="Contact Us">My Orders</a></li>
							<li><a href="#" title="Contact Us">Wishlist</a></li>

						</ul>
					</div>
				</div>

				
			</div>
		</div>
		<div class="copyright-area">
			<div class="container">
				<div class="row">
					<div class="col-12 mt-3">
						<div class="copy-right text-center">
							<p>&copy; {{ date('Y') }}  Amazing Shop. All Rights Reserved</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- wishlist Modal -->
	<div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Success</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script src="{{asset ('front-assets/js/jquery-3.6.0.min.js') }}"></script>
	<script src="{{asset ('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
	<script src="{{asset ('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
	<script src="{{asset ('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
	<script src="{{asset ('front-assets/js/slick.min.js') }}"></script>
	<script src="{{asset ('front-assets/js/ion.rangeSlider.min.js') }}"></script>
	<script src="{{asset ('front-assets/js/custom.js') }}"></script>
	<script>
		window.onscroll = function() {
			myFunction()
		};

		var navbar = document.getElementById("navbar");
		var sticky = navbar.offsetTop;

		function myFunction() {
			if (window.pageYOffset >= sticky) {
				navbar.classList.add("sticky")
			} else {
				navbar.classList.remove("sticky");
			}
		}
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

	
		
	</script>
	@yield('customJs')
</body>

</html>
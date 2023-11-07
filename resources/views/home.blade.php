<!DOCTYPE html>
<html lang="en">
<head>
	<!-- head -->
	@include('head')
</head>
<body> <!-- class="animsition"-->
	<!-- Header -->
	@include('header')
	<!-- Cart -->	
	@include('cart')

	@yield('content')
	

<!-- Footer -->
	@include('footer')

</body>
</html>
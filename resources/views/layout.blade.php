<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="book.ico"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('header')
</head>
<body>
	<!---content is the identifier. It can be anything you want for a section you want to create in you view. -->
	@yield('content')

	@yield('footer')
</body>
</html>
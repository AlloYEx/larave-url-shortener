<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;700&display=swap"
			rel="stylesheet"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="36x36"
			href="./images/png-transparent-computer-icons-html-web-design-web-development-web-design-angle-web-design-text-thumbnail.png"
		/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
		<link rel="stylesheet" href="./styles/main.css" />
		<title>URL Shortener</title>
	</head>
	<body>
		<main class="main-block">
			<h1 class="main-block__head">URL Shortener</h1>
			<div class="main-block__content">
				<h2>Paste the URL to be shortened</h2>
				<form action="{{ route('make') }}" method="POST">
          @csrf
					<input
						type="text"
						placeholder="Enter the link here"
						name="link"
					/>
					<button type="submit">Generate URL</button>
				</form>
        @if(session('success'))
        <div class="main-block__description">
					<p>New URL: <a target="_blank" href="{{ route('url', session('link')) }}">{{ 'http://shortener.test/' . session('link') }}</a></p>
					<p>Create other link right here!</a></p>
				</div>
        @else
				<div class="main-block__description">
					<p>Here you can shorten your URL fast and simple!</p>
					<p>
						Use it to create a shortened link making it easy to
						remember
					</p>
				</div>
        @endif
			</div>
		</main>

    <script src="/assets/jquery-3.2.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if(session('success'))
    <script>
      toastr.success('{{ session('success') }}');
    </script>
    @elseif(session('error'))
    <script>
      toastr.error('{{ session('error') }}');
    </script>
    @endif
	</body>
</html>

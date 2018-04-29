<!DOCTYPE html>
<html lang="{{ $language or 'en-us' }}">
<head>
    <title>{{ $title }}</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="content-language" content="{{ $language or 'en-us' }}" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robot" content="noindex, nofollow" />
    <meta name="keywords" content="laracrumbs, administration, breadcrumbs, laravel" />
    <meta name="description" content="Administration for Laracrumbs" />
    <meta name="author" content="K. McCormick" />
    <meta name="copyright" content="&copy; 2018" />
    <link href="{{ asset('vendor/laracrumbs/css/styles.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/laracrumbs/js/scripts.js') }}"></script>
</head>
<body id="laracrumbsWrapper">
<div id="laracrumbsAccessNav">
    <ul>
        <li><a href="#navbar">@lang('laracrumbs::layout.skip_to_nav')</a></li>
        <li><a href="#primary">@lang('laracrumbs::layout.skip_to_page')</a></li>
    </ul>
</div><!--end #laracrumbsAccessNav-->
<header>
    <nav id="navbar">
        <ul>
            <li><a href="{{ route('laracrumbs_home') }}">Laracrumbs</a></li>
            <li><a href="{{ route('laracrumbs_browse') }}">Browse</a></li>
            <li><a href="{{ route('laracrumbs_routes') }}">Routes</a></li>
        </ul>
    </nav>
    <div id="breadcrumbs">
        {!! Laracrumbs::render() !!}
    </div>
    <h1>{{ $title }}</h1>
    @if (!empty($subtitle))<h2>{{ $subtitle }}</h2>@endif
</header>
<main id="primary">
    @include($template)
</main><!--end #primary-->
<footer>
    <div class='laracrumbsCopyright'>&copy; K. McCormick</div>
    <div class='laracrumbsUpdate'>2018-04-28</div>
    <div id='laracrumbsRepo'>
        <a href="https://github.com/blackdrago/laracrumbs" title="@lang('laracrumbs::layout.link_github')"><i class="fa fa-github" aria-hidden="true"></i></a>
    </div>
</footer>
</body>
</html>

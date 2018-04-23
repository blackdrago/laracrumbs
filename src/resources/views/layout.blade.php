<html lang="{{ $language or 'en' }}">
<head>
    <title>{{ $title }}</title>
    <link href="{{ asset('vendor/laracrumbs/styles.css') }}" rel="stylesheet" />
    <script src="{{ asset('vendor/laracrumbs/scripts.js') }}"></script>
</head>
<body id="laracrumbsWrapper">
<div id="laracrumbsAccessNav">
    <ul>
        <li><a href="#navbar">@lang('laracrumbs::layout.skip_to_nav')</a></li>
        <li><a href="#primary">@lang('laracrumbs::layout.skip_to_page')</a></li>
    </ul>
</div><!--end #laracrumbsAccessNav-->
<header>
    <h1>{{ $title }}</h1>
</header>
<nav id='navbar'>
    <ul>
        <li><a href="{{ route('laracrumbsHome') }}">Laracrumbs</a></li>
    </ul>
</nav><!--end #navbar-->
<main id='primary'>
    {{ $content }}
    <hr />
    @foreach ($crumbs as $crumb)
        <p>Crumb {{ $crumb->name }} id = {{ $crumb->id }}</p>
        <p>
        @foreach($crumb->collectCrumbs() as $line)
            @if ($line->hasLink())<a href="{{ $crumb->link() }}" @if ($line->hasTitle())title="{{ $line->title() }}"@endif>@endif
            {{ $line->name() }}
            @if ($line->hasLink())</a>@endif
            @if (!$loop->last) &gt;&gt; @endif
        @endforeach
        </p>
{{--        <pre>@php (var_dump($crumb->collectCrumbs()))</pre> --}}
    @endforeach
    <hr />
    <h3>Laracrumbs (Plain)</h3>
    @include('laracrumbs::partials.laracrumbs', [
        'laracrumb' => $crumb,
        'separator' => '&gt;&gt;',
    ])
    <hr />
    <h3>Laracrubs List</h3>
    @include('laracrumbs::partials.laracrumbs-list', [
        'laracrumb' => $crumb
    ])
</main><!--end #primary-->
<footer>
    &copy; K. McCormick &#124; Last updated 2018-04-22
</footer>
</body>
</html>

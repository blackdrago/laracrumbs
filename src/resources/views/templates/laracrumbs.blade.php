<div class="{{ $laracrumbClass or 'laracrumbs-bar' }}" id="{{ $laracrumbID or 'breadcrumbs' }}">
@foreach($laracrumb->collectCrumbs() as $crumb)
    <span class="{{ $laracrumbItemClass or 'laracrumbs-section' }}">
    @include('laracrumbs::templates.laracrumb', [
        'crumb'    => $crumb,
        'linkAttr' => !empty($settings) ? $settings : []
    ])
    @if (!$loop->last)
        {!! $laracrumbSeparator or '&gt;&gt;' !!}
    @endif
    </span>
@endforeach
</div>

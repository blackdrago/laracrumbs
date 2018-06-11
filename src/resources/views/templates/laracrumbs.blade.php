<div class="{{ config('laracrumbs.class_wrapper') }}" id="{{ $laracrumbID or 'breadcrumbs' }}">
@foreach($laracrumb->collectCrumbs() as $crumb)
    <span class="{{ config('laracrumbs.class_item') }}">
    @include('laracrumbs::templates.laracrumb', [
        'crumb'    => $crumb,
        'linkAttr' => !empty($settings) ? $settings : []
    ])
    @if (!$loop->last)
        {!! config('laracrumbs.separator') !!}
    @endif
    </span>
@endforeach
</div>

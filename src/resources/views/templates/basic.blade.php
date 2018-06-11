@foreach($laracrumb->collectCrumbs() as $crumb)
    @include('laracrumbs::templates.laracrumb', [
        'crumb'    => $crumb,
        'linkAttr' => !empty($settings) ? $settings : []
    ])
    @if (!$loop->last) {!! config('laracrumbs.separator') !!} @endif
@endforeach

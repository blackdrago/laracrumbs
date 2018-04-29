@foreach($laracrumb->collectCrumbs() as $crumb)
    @include('laracrumbs::templates.laracrumb', [
        'crumb'    => $crumb,
        'linkAttr' => !empty($settings) ? $settings : []
    ])
    @if (!$loop->last) {!! $separator or '&gt;' !!} @endif
@endforeach

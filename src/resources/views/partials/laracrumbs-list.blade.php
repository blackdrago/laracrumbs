@php ($listTag = empty($isOrdered) ? 'ul' : 'ol')
<{{ $listTag }} class="{{ $listClass or 'laracrumbList' }}">
@foreach($laracrumb->collectCrumbs() as $crumb)
    <li class="{{ $liClass or 'laracrumbListItem' }}">
    @include('laracrumbs::partials.laracrumb', [
        'crumb' => $crumb,
        'linkAttr' => !empty($settings) ? $settings : []
    ])
    </li>
@endforeach
</{{ $listTag }}>

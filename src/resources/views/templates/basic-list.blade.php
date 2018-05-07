@php ($listTag = empty($isOrdered) ? 'ul' : 'ol')
<{{ $listTag }} class="{{ $listClass or 'laracrumbList' }}">
@foreach($laracrumb->collectCrumbs() as $crumb)
    <li class="{{ $liClass or 'laracrumbListItem' }}">
    @include('laracrumbs::templates.basic', [
        'crumb'    => $crumb,
        'linkAttr' => !empty($settings) ? $settings : []
    ])
    </li>
@endforeach
</{{ $listTag }}>

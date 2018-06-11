@php ($listTag = empty($isOrdered) ? 'ul' : 'ol')
<{{ $listTag }} class="{{ config('laracrumbs.class_list') }}">
@foreach($laracrumb->collectCrumbs() as $crumb)
    <li class="{{ config('laracrumbs.class_list_item') }}">
    @include('laracrumbs::templates.basic', [
        'crumb'    => $crumb,
        'linkAttr' => !empty($settings) ? $settings : []
    ])
    </li>
@endforeach
</{{ $listTag }}>

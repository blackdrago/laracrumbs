@if ($crumb->hasLink())
<a href="{{ $crumb->link() }}" @if ($crumb->hasTitle())title="{{ $crumb->title() }}"@endif @if(!empty($linkAttrs)) @foreach($linkAttrs as $n => $v){{ $n }}="{{ $v }}" @endforeach @endif>{{ $crumb->name() }}</a>
@else
{{ $crumb->name() }}
@endif


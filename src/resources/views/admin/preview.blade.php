    <div class="laracrumbsPreview">
    @if (!empty($crumbTemplate))
        @include($crumbTemplate)
    @else
        @include('laracrumbs::templates.basic')
    @endif
    </div>

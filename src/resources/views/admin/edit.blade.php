    <div class="laracrumbsForm">
        @if (empty($laracrumb))<h3>Create New</h3>
        @else                  <h3>Edit {{ $laracrumb->name() }}</h3>
        @endif
        <form name='laracrumb' id='laracrumb' method='post' action=''>
            @foreach($fields as $field)
            <div class='laracrumbField'>
                <label for="{{ $field['name'] }}">@lang("laracrumbs::admin.label_{$field['name']}")</label>
                <input type="text" id="{{ $field['name'] }}" name="{{ $field['name'] }}" value="{{ Laracrumbs::fieldValue($laracrumb, $field['name']) }}" />
            </div>
            @endforeach
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>@lang('laracrumbs::admin.header_identifier')</th>
                <th>@lang('laracrumbs::admin.header_methods')</th>
                <th>@lang('laracrumbs::admin.header_linkname')</th>
                <th>@lang('laracrumbs::admin.header_hasit')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($routes as $route)
            <tr>
                <td>{{ \Laracrumbs\Services\RouteService::getIdentifier($route) }}</td>
                <td>{!! implode('<br />', $route->methods()) !!}</td>
                <td>
                    @if (!empty($route->getName()) && empty($route->parameterNames()))
                        <a href="{{ route($route->getName()) }}">{{ $route->getName() }}</a>
                    @else
                        &nbsp;
                    @endif
                </td>
                <td>
                @if (\Laracrumbs\Services\RouteService::hasLaracrumb($route))
                    @lang('laracrumbs::admin.affirmative')
                @else
                    @lang('laracrumbs::admin.negative')
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

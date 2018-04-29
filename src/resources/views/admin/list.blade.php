    <div class="laracrumbBrowse">
    @foreach($laracrumbs as $crumb)
        <div class="laracrumbsBrowseRow" id="laracrumb_{{ $crumb->id() }}">
            <div class="laracrumbsBrowseName">{{ $crumb->name() }}</div>
            <div class="laracrumbsBrowseUtils">
                <a class="laracrumbsUtilityButton" href="{{ route('laracrumbs_preview', $crumb->id()) }}" title="@lang('laracrumbs::admin.link_preview', ['name' => $crumb->name()])"><i class="fa fa-eye"></i></a>
                <a class="laracrumbsUtilityButton" href="{{ route('laracrumbs_edit', $crumb->id()) }}" title="@lang('laracrumbs::admin.link_edit', ['name' => $crumb->name()])"><i class="fa fa-cog"></i></a>
                <a class="laracrumbsUtilityButton" href="{{ route('laracrumbs_delete', $crumb->id()) }}" title="@lang('laracrumbs::admin.link_delete', ['name' => $crumb->name()])"><i class="fa fa-times"></i></a>
            </div>
        </div>
    @endforeach
    </div>
{{--
    <table id="laracrumbBrowse">
        <caption>
            @lang('laracrumbs::admin.caption_browse')
        </caption>
        <thead>
            <tr>
                <th scope="col">@lang('laracrumbs::admin.header_text')</th>
                <th scope="col">@lang('laracrumbs::admin.header_preview')</th>
                <th scope="col">@lang('laracrumbs::admin.header_edit')</th>
                <th scope="col">@lang('laracrumbs::admin.header_delete')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($laracrumbs as $crumb)
            <tr id="laracrumb_{{ $crumb->id() }}">
                <th scope="row">{{ $crumb->name() }}</th>
                <td><a href="{{ route('laracrumbs_preview', $crumb->id()) }}" title="@lang('laracrumbs::admin.link_preview', ['name' => $crumb->name()])"><i class="fa fa-eye"></i></a></td>
                <td><a href="{{ route('laracrumbs_edit', $crumb->id()) }}" title="@lang('laracrumbs::admin.link_edit', ['name' => $crumb->name()])"><i class="fa fa-cog"></i></a></td>
                <td><a href="{{ route('laracrumbs_delete', $crumb->id()) }}" title="@lang('laracrumbs::admin.link_delete', ['name' => $crumb->name()])"><i class="fa fa-times"></i></a></td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        </tfoot>
    </table>
--}}

<?php
/**
 * Contains the AdminController class.
 *
 * @package Laracrumbs\Http\Controllers
 */
namespace Laracrumbs\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * AdminController handles administrative and preview routes for Laracrumbs.
 */
class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Landing/home page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        return view('laracrumbs::admin.layout', [
            'title'    => trans('laracrumbs::admin.title', ['name' => config('app.name')]),
            'template' => 'laracrumbs::admin.index'
        ]);
    }

    /**
     * View the existing routes of this application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function routes(Request $request)
    {
        return view('laracrumbs::admin.layout', [
            'title'    => trans('laracrumbs::admin.title_full'),
            'template' => 'laracrumbs::admin.routes',
            'crumbs'   => \Laracrumbs\Models\Laracrumb::all(),
            'routes'   => \Route::getRoutes(),
        ]);
    }
}

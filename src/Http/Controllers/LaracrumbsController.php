<?php
/**
 * Contains the LaracrumbsController class.
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
 * LaracrumbsController handles administrative and preview routes for Laracrumbs.
 */
class LaracrumbsController extends Controller
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
        return view('laracrumbs::layout', [
            'title'   => 'Laracrumbs Home',
            'content' => 'Moose and Squirrel',
            'crumbs'  => \Laracrumbs\Models\Laracrumb::all(),
        ]);
    }
}

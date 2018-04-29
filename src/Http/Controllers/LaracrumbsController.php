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
 * LaracrumbsController handles administrative and view routes for Laracrumbs.
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
            'content' => 'Laracrumbs content goes here.',
            'crumbs'  => \Laracrumbs\Models\Laracrumb::all(),
        ]);
    }

    /**
     * Administration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function admin(Request $request)
    {
        return view('laracrumbs::admin-layout', [
            'title'   => 'Laracrumbs Administration',
            'content' => 'Laracrumbs content goes here.',
        ]);
    }
}

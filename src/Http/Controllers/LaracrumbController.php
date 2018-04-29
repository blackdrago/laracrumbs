<?php
/**
 * Contains the LaracrumbController class.
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
use Laracrumbs\Models\Laracrumb;
use Laracrumbs\Services\InputService;

/**
 * LaracrumbsController handles CRUD operations for Laracrumbs.
 */
class LaracrumbController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laracrumbs = Laracrumb::all();
        return view('laracrumbs::admin.layout', [
            'title'      => trans('laracrumbs::admin.title_browse'),
            'template'   => 'laracrumbs::admin.list',
            'laracrumbs' => $laracrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laracrumbs::admin.layout', [
            'title'     => trans('laracrumbs::admin.title_create'),
            'template'  => 'laracrumbs::admin.edit',
            'laracrumb' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = InputService::cleanInput($request->all());
        $laracrumb = new Laracrumb();
        foreach($input as $field => $value) {
            $laracrumb->$field = $value;
        }
        $laracrumb->save();
        // TODO: success message
        return redirect()->route('laracrumbs_home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO: error handling
        $laracrumb = Laracrumb::find($id);
        return view('laracrumbs::admin.layout', [
            'title'     => trans('laracrumbs::admin.title_view', ['name' => $laracrumb->text]),
            'template'  => 'laracrumbs::admin.preview',
            'laracrumb' => $laracrumb,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO: error handling
        $laracrumb = Laracrumb::find($id);
        return view('laracrumbs::admin.layout', [
            'title'     => trans('laracrumbs::admin.title_edit', ['name' => $laracrumb->text]),
            'template'  => 'laracrumbs::admin.edit',
            'laracrumb' => $laracrumb,
            'fields'    => [
                ['name' => 'text'],
                ['name' => 'link'],
                ['name' => 'route_name'],
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO: error handling
        $laracrumb = Laracrumb::find($id);
        $input = InputService::cleanInput($request->all());
        foreach($input as $field => $value) {
            $laracrumb->$field = $value;
        }
        $laracrumb->save();
        // TODO: success message
        return redirect()->route('laracrumbs_home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: error handling
        $laracrumb = Laracrumb::find($id);
        $laracrumb->delete();
        // TODO: success message
        return redirect()->route('laracrumbs_home');
    }
}

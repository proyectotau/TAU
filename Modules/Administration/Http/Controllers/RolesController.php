<?php

namespace Modules\Administration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Administration\AdminRolesManager;

class RolesController extends Controller
{
    protected $commandBus;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $criteria = $request->criteria;
        $roles = AdminRolesManager::index([
            'criteria'   => $criteria
        ])->toObject();

        return view('administration::roles.index', compact('roles', 'criteria'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administration::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $role = AdminRolesManager::store([
            'name'    => $request->name,
            'description' => $request->description
        ])->toObject();

        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $role = AdminRolesManager::show([
            'id' => $id
        ])->toObject();

        return view('administration::roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $role = AdminRolesManager::show([
            'id' => $id
        ])->toObject();

        return view('administration::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        AdminRolesManager::update([
            'id'      => $request->id,
            'name'    => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        AdminRolesManager::destroy([
            'id' => $request->id,
        ]);

        return redirect()->route('admin.roles.index');
    }
}

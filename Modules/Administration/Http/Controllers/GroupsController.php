<?php

namespace Modules\Administration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Administration\AdminGroupsManager;

class GroupsController extends Controller
{
    protected $commandBus;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $groups = AdminGroupsManager::index([
            'criteria'   => $request->criteria
        ])->toObject();

        return view('administration::groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administration::groups.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $group = AdminGroupsManager::store([
            'name'    => $request->name,
            'description' => $request->description
        ])->toObject();

        return redirect()->route('admin.groups.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $group = AdminGroupsManager::show([
            'id' => $id
        ])->toObject();

        return view('administration::groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $group = AdminGroupsManager::show([
            'id' => $id
        ])->toObject();

        return view('administration::groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        AdminGroupsManager::update([
            'id'      => $request->id,
            'name'    => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.groups.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        AdminGroupsManager::destroy([
            'id' => $request->id,
        ]);

        return redirect()->route('admin.groups.index');
    }
}

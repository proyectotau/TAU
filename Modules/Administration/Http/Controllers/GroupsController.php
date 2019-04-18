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
        $criteria  = $request->criteria;
        $groups = AdminGroupsManager::index([
            'criteria'   => $criteria
        ])->toObject();

        return view('administration::groups.index', compact('groups', 'criteria'));
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

    /*
     * Relations
     */


    /*
     * Given a Group ID, index Group's Users and User's Available Groups in a selection box
     * @param id Group ID
     * @comment group's Users
     */
    public function groupsUsers($id){
        $users = AdminGroupsManager::groupsUsers([
            'id' => $id,
        ])->toObject();

        $users_available = AdminGroupsManager::groupsUsersNotIn([
            'id' => $id,
        ])->toObject();

        $group = AdminGroupsManager::show([
            'id' => $id
        ])->toObject();

        $high = min(max(count($users), count($users_available))+1, 20);
        return view('administration::groups.roles', compact('users', 'users_available', 'group', 'high'));
    }

    /*
     * Given a Group ID, index Group's Roles and Group's Available Roles in a selection box
     * @param id Group ID
     */
    public function groupsRoles($id){
        $roles = AdminGroupsManager::groupsRoles([
            'id' => $id,
        ])->toObject();

        $roles_available = AdminGroupsManager::groupsRolesNotIn([
            'id' => $id,
        ])->toObject();

        $group = AdminGroupsManager::show([
            'id' => $id
        ])->toObject();

        $high = min(max(count($roles), count($roles_available))+1, 20);
        return view('administration::groups.roles', compact('roles', 'roles_available', 'group', 'high'));
    }

    /**
     * Update new list Group's Roles for a given Group ID
     */
    public function groupsRolesUpdate(Request $request){
        $id = $request->id;
        $memberOf = $request->miembro; // TODO rename miembro in view

        $roles = AdminGroupsManager::groupsRolesUpdate([
            'id' => $id,
            'memberOf' => $memberOf,
        ])->toObject();

        $roles_available = AdminGroupsManager::groupsRolesNotIn([
            'id' => $id,
        ])->toObject();

        $group = AdminGroupsManager::show([
            'id' => $id
        ])->toObject();

        $high = min(max(count($roles), count($roles_available))+1, 20);
        return view('administration::groups.roles', compact('group', 'roles', 'roles_available', 'high'));
	}
}

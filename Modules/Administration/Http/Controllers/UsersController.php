<?php

namespace Modules\Administration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Administration\AdminUsersManager;

class UsersController extends Controller
{
    protected $commandBus;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $criteria  = $request->criteria;
        $users = AdminUsersManager::index([
            'criteria'   => $criteria
        ])->toObject();

        return view('administration::users.index', compact('users', 'criteria'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('administration::users.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user = AdminUsersManager::store([
            'login'   => $request->login,
            'name'    => $request->name,
            'surname' => $request->surname
        ])->toObject();

        return redirect()->route('admin.users.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $user = AdminUsersManager::show([
            'id' => $id
        ])->toObject();

        return view('administration::users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $user = AdminUsersManager::show([
            'id' => $id
        ])->toObject();

        return view('administration::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        AdminUsersManager::update([
            'id'      => $request->id,
            'login'   => $request->login,
            'name'    => $request->name,
            'surname' => $request->surname
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        AdminUsersManager::destroy([
            'id' => $request->id,
        ]);

        return redirect()->route('admin.users.index');
    }

    /*
     * Relations
     */

    /*
     * Given a User ID, index User's Groups and User's Available Groups in a selection box
     * @param id User ID
     */
    public function usersGroups($id){
        $groups = AdminUsersManager::usersGroups([
            'id' => $id,
        ])->toObject();

        $groups_available = AdminUsersManager::usersGroupsNotIn([
            'id' => $id,
        ])->toObject();

        $user = AdminUsersManager::show([
            'id' => $id
        ])->toObject();

        $high = min(max(count($groups), count($groups_available))+1, 20);
        return view('administration::users.groups', compact('user', 'groups', 'groups_available', 'high'));
    }

    /**
     * Update new list User's Groups for a given User ID
     */
    public function usersGroupsUpdate(Request $request){
        $id = $request->id;
        $memberOf = $request->miembro; // TODO rename miembro in view

        $groups = AdminUsersManager::usersGroupsUpdate([
            'id' => $id,
            'memberOf' => $memberOf,
        ])->toObject();

        $groups_available = AdminUsersManager::usersGroupsNotIn([
            'id' => $id,
        ])->toObject();

        $user = AdminUsersManager::show([
            'id' => $id
        ])->toObject();

        $high = min(max(count($groups), count($groups_available))+1, 20);
        return view('administration::users.groups', compact('user', 'groups', 'groups_available', 'high'));
    }
}
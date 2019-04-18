<?php

namespace Modules\Administration\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Administration\AdminGroupsManager;

class GroupsController extends Controller
{
    public function test(Request $request)
    {
        return AdminGroupsManager::test([
            'id'      => $request->json('id'),
            'name'    => $request->json('name'),
            'surname' => $request->json('surname')
        ])->toJson();
    }

    /**
     * Display a listing of the resource Group
     * @return Response
     */
    public function index(Request $request)
    {
        $response = AdminGroupsManager::index([
            'criteria'   => $request->criteria // TODO
        ])->toJson();

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // TODO: Validate inputs
        $response = AdminGroupsManager::store([
            'name'    => $request->json('name'),
            'description' => $request->json('description')
        ])->toJson();

        return $response; //->setStatusCode(Response::HTTP_CREATED); // TODO
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $response = AdminGroupsManager::show([
                'id' => $id
         ])->toJson();

        return $response;
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $response = AdminGroupsManager::update([
                'id'      => $request->json('id'),
                'name'    => $request->json('name'),
                'description' => $request->json('description'),
        ])->toJson();

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $response = AdminGroupsManager::destroy([
            'id' => $request->json('id'),
        ])->toJson();

        return $response;
    }

    /*
     * Relations
     */

    /*
     * Given a User ID, index User's Groups and User's Available Groups in a selection box
     * @param id Group ID
     */
    public function groupsUsers($id){
        $users = AdminGroupsManager::groupsUsers([
            'id' => $id,
        ])->toJson();

        return $users;
    }

    public function groupsUsersNotIn(Request $request)
    {
        $users_available = AdminGroupsManager::GroupsUsersNotIn([
            'id' => $request->id
        ])->toJson();

        return $users_available;
    }

    public function groupsUsersUpdate(Request $request){
        $users = AdminGroupsManager::groupsUsersUpdate([
            'id' => $request->id,
            'memberOf' => $request->memberOf,
        ])->toJson();

        return $users;
    }

    /*
     * Given a Group ID, index Roles that grant access to the members of that Group
     */
    public function groupsRoles($id){
        $roles = AdminGroupsManager::groupsRoles([
            'id' => $id,
        ])->toJson();

        return $roles;
    }

    /*
     * Given a Group ID, index to Roles where Group not belongs to
     * @param id Group ID
     */
    public function groupsRolesNotIn(Request $request)
    {
        $roles_available = AdminGroupsManager::GroupsRolesNotIn([
            'id' => $request->id
        ])->toJson();

        return $roles_available;
    }

    /*
     * Update new list Group's Roles for a given Group ID
     * @param id Group ID
     */
    public function groupsRolesUpdate(Request $request){
        $roles = AdminGroupsManager::groupsRolesUpdate([
            'id' => $request->id,
            'memberOf' => $request->memberOf,
        ])->toJson();

        return $roles;
    }
}

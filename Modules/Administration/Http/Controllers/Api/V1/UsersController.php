<?php

namespace Modules\Administration\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Administration\AdminUsersManager;

class UsersController extends Controller
{
    public function test(Request $request)
    {
        return AdminUsersManager::test([
            'id'      => $request->json('id'),
            'name'    => $request->json('name'),
            'surname' => $request->json('surname')
        ])->toJson();
    }

    public function testview(Request $request)
    {
        return view('testviewc', ['user' => null]);
    }

    /**
     * Display a listing of the resource User
     * @return Response
     */
    public function index(Request $request)
    {
        $response = AdminUsersManager::index([
            'criteria'   => $request->criteria
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
        $response = AdminUsersManager::store([
            'login'   => $request->json('login'),
            'name'    => $request->json('name'),
            'surname' => $request->json('surname')
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
        $response = AdminUsersManager::show([
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
        $response = AdminUsersManager::update([
                'id'      => $request->json('id'),
                'name'    => $request->json('name'),
                'surname' => $request->json('surname'),
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
        $response = AdminUsersManager::destroy([
            'id' => $request->json('id'),
        ])->toJson();

        return $response;
    }

    /*
     * Relations
     */

    /*
     * Given a User ID, index to User's Groups
     * @param id User ID
     */
    public function usersGroups(Request $request){
        $groups = AdminUsersManager::usersGroups([
            'id' => $request->id
        ])->toJson();

        return $groups;
    }

    /*
     * Given a User ID, index to Groups where User not belongs to
     * @param id User ID
     */
    public function usersGroupsNotIn(Request $request){
        $groups_available = AdminUsersManager::usersGroupsNotIn([
            'id' => $request->id
        ])->toJson();

        return $groups_available;
    }

    /**
     * Update new list User's Groups for a given User ID
     * @return The Same that usersGroups()
     */
    public function usersGroupsUpdate(Request $request){
        $groups = AdminUsersManager::usersGroupsUpdate([
            'id' => $request->id,
            'memberOf' => $request->memberOf,
        ])->toJson();

        return $groups;
    }
}

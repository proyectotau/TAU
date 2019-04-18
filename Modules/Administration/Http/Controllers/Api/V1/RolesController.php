<?php

namespace Modules\Administration\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Administration\AdminRolesManager;

class RolesController extends Controller
{
    public function test(Request $request)
    {
        return AdminRolesManager::test([
            'id'      => $request->json('id'),
            'name'    => $request->json('name'),
            'surname' => $request->json('surname')
        ])->toJson();
    }

    /**
     * Display a listing of the resource Role
     * @return Response
     */
    public function index(Request $request)
    {
        $response = AdminRolesManager::index([
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
        $response = AdminRolesManager::store([
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
        $response = AdminRolesManager::show([
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
        $response = AdminRolesManager::update([
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
        $response = AdminRolesManager::destroy([
            'id' => $request->json('id'),
        ])->toJson();

        return $response;
    }

    public function rolesGroups(Request $request){
        $response = AdminRolesManager::rolesGroups([
            'id' => $request->json('id'),
        ])->toJson();

        return $response;
    }

    public function rolesGroupsNotIn(Request $request){
        $response = AdminRolesManager::rolesGroupsNotIn([
            'id' => $request->json('id'),
        ])->toJson();

        return $response;
    }

}

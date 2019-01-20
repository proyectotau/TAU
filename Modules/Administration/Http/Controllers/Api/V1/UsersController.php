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
}

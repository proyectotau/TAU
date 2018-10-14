<?php

namespace Modules\Administration\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Joselfonseca\LaravelTactician\Bus as CommandBus;
use Modules\Administration\AdminUsersManager;

class UsersController extends Controller
{
    protected $commandBus;

    public function __construct() // TODO: Move to binding in ServiceProvider
    {
        //$this->commandBus = resolve('admin.commandbus');
        //$this->commandBus = app('admin.bus');
    }

    /**
     * Display a listing of the resource User
     * @return Response
     */
    public function index() // TODO: Add criteria
    {
        $response = AdminUsersManager::index();

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
        ]);

        return $response;
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
         ]);

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
            ]);

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
        ]);

        return $response;
    }
}

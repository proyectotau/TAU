<?php

namespace Modules\Administration\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Joselfonseca\LaravelTactician\Bus as CommandBus;
use Modules\Administration\Commands\Handler\Handler;
use Modules\Administration\Commands\IndexUser; // TODO: as CommandUser interface?
use Modules\Administration\Commands\User as StoreUser;
use Modules\Administration\Commands\User as ShowUser;
use Modules\Administration\Commands\User as UpdateUser;
use Modules\Administration\Commands\User as DestroyUser;


use Modules\Administration\Tests\Commands\StubEchoCommandHandler;
use Modules\Administration\Tests\Commands\StubJsonCommandHandler;

class UsersController extends Controller
{
    protected $commandBus;

    public function __construct() // TODO: Move to binding in ServiceProvider
    {
        $this->commandBus = app('admin.bus');
    }

    /**
     * Display a listing of the resource User
     * @return Response
     */
    public function index(Request $request) // TODO: Add criteria
    {
        $response = $this->commandBus->dispatch('Modules\Administration\Commands\IndexUser', [], []);

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $data)
    {
        return view('administration::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // TODO: Validate inputs
        $response = $this->commandBus->dispatch('Modules\Administration\Commands\StoreUser',
            [
                'id'      => $request->json('id'),
                'name'    => $request->json('name'),
                'surname' => $request->json('surname')
            ], []);

        return $response;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $response = $this->commandBus->dispatch('Modules\Administration\Commands\ShowUser',
            [
                'id' => $id
            ], []);

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('administration::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        //dd($request->getContent());
        $response = $this->commandBus->dispatch('Modules\Administration\Commands\UpdateUser',
            [
                'id'      => $request->json('id'),
                'name'    => $request->json('name'),
                'surname' => $request->json('surname'),
            ], []);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $response = $this->commandBus->dispatch('Modules\Administration\Commands\DestroyUser',
            [
                'id' => $request->json('id'),
            ], []);

        return $response;
    }
}

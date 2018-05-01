<?php

namespace Modules\Administration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Joselfonseca\LaravelTactician\Bus as CommandBus;
use Modules\Administration\Commands\Handler\Handler;
use Modules\Administration\Commands\User as IndexUser; // TODO: as CommandUser interface?
use Modules\Administration\Commands\User as StoreUser;
use Modules\Administration\Commands\User as ShowUser;
use Modules\Administration\Commands\User as UpdateUser;
use Modules\Administration\Commands\User as DestroyUser;


use Modules\Administration\Tests\Commands\StubEchoCommandHandler;
use Modules\Administration\Tests\Commands\StubJsonCommandHandler;

class AdministrationController extends Controller
{
    protected $commandHandler;

    public function __construct(Handler $commandHandler) // TODO: Move to binding in ServiceProvider
    {
        $this->commandHandler = $commandHandler;
    }

    // TODO: Move as a helper
    private function getInstanceOfCommandBus(){
        $commandBus = app(CommandBus::class);
        return $commandBus;
    }

    private function bindCommandToHandler($commandBus, $command, $handler){
        // echo 'Binding '.$command.' => '.$handler.PHP_EOL;
        $commandBus->addHandler($command, $handler);
    }

    /**
     * Display a listing of the resource.User
     * @ return Response
     */
    public function index(Request $request) // TODO: Add criteria
    {
        $commandBus = $this->getInstanceOfCommandBus();
        //$this->bindCommandToHandler($commandBus, User::class, StubJsonCommandHandler::class);
        //$this->bindCommandToHandler($commandBus, User::class, UserIndexCommandHandler::class);
        $this->bindCommandToHandler($commandBus, IndexUser::class, $this->commandHandler);

        $response = $commandBus->dispatch(IndexUser::class, [], []);

        return $response;
        //return view('administration::test')->with('users', $response);
        //return view('administration::test', $response);
        //return view('administration::index')->with('users', $response);
        //return view('administration::test', ['users' => json_decode($response)]);
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

        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, StoreUser::class, $this->commandHandler);
        $response = $commandBus->dispatch(StoreUser::class,
            [
                'name'    => $request->json('name'),
                'surname' => $request->json('surname')
            ], []);

        return $response;
    }

    /**
     * Show the specified resource.
     * @param int $user
     * @return Response
     */
    public function show($user)
    {
        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, ShowUser::class, StubJsonCommandHandler::class);
        $response = $commandBus->dispatch(ShowUser::class,
            [
                'id' => $user, //$request->json('user'),
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
     * @param  int $user
     * @param  Request $request
     * @return Response
     */
    public function update($user, Request $request)
    {
        // save
        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, UpdateUser::class, StubJsonCommandHandler::class);
        $response = $commandBus->dispatch(UpdateUser::class,
            [
                'id'      => $user,
                'name'    => $request->json('name'),
                'surname' => $request->json('surname'),
            ], []);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($user)
    {
        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, DestroyUser::class, StubJsonCommandHandler::class);
        $response = $commandBus->dispatch(DestroyUser::class,
            [
                'id' => $user, //$request->json('user'),
            ], []);

        return $response;
    }
}

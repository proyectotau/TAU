<?php

namespace Modules\Administration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Administration\Commands\User;
use Joselfonseca\LaravelTactician\Bus as CommandBus;
use Modules\Administration\Tests\Commands\StubEchoCommandHandler;
use Modules\Administration\Tests\Commands\StubJsonCommandHandler;

use Tests\Integration\Providers\Alguien;
use Tests\Integration\Providers\Paco;
use Tests\Integration\Providers\Pepe;

class AdministrationController extends Controller
{
    private $commandBus;

    public function __construct(Alguien $quien)
    {
        //$quien = resolve('Tests\Integration\Providers\Alguien');
        //dd(get_class($quien));
        //dd($quien->soy());
        echo 'Se ha llamado a __construct() de AdministrationController: '. $quien->soy().PHP_EOL;
    }

    private function getInstanceOfCommandBus(){
        $commandBus = app(CommandBus::class);
        return $commandBus;
    }

    private function bindCommandToHandler($commandBus, $command, $handler){
        $commandBus->addHandler($command, $handler);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, User::class, StubJsonCommandHandler::class);
        $response = $commandBus->dispatch(User::class, [], []);

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $data)
    {
        return $data;
        //return view('administration::create');

    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request->getContent());
        //dd($request->json('name'));

        $commandBus = $this->getInstanceOfCommandBus();
        $this->bindCommandToHandler($commandBus, User::class, StubJsonCommandHandler::class);
        $response = $commandBus->dispatch(User::class,
            [
                'name' => $request->json('name'),
                'surname' =>$request->json('surname')
            ], []);
        //dd($response);
        return $response;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('administration::show');
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
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}

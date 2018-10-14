<?php

namespace Modules\Administration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Administration\AdminUsersManager;

class UsersController extends Controller
{
    protected $commandBus;

    public function __construct() // TODO: Move to binding in Service App
    {
        //$this->commandBus = resolve('admin.commandbus');
        //$this->commandBus = app('admin.bus');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = AdminUsersManager::index();

        return view('administration::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
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
        $user = AdminUsersManager::store([
            'login'   => $request->login,
            'name'    => $request->name,
            'surname' => $request->surname
        ]);

        return $this->index(); // TODO: visual feedback of recently stored user
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $user = AdminUsersManager::show([
            'id' => $id
        ]);

        return view('administration::show', compact('user'));
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
        $user = AdminUsersManager::store([
            'login'   => $request->login,
            'name'    => $request->name,
            'surname' => $request->surname
        ]);

        return $this->index(); // TODO: visual feedback of recently stored user
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

        return $this->index(); // TODO: visual feedback of recently deleted user
    }
}

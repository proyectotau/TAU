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
        $users = AdminUsersManager::index([
            'criteria'   => $request->criteria
        ])->toObject();

        return view('administration::users.index', compact('users'));
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
}

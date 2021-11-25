<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(UserInterface $interface, Request $request)
    {
        return response()->json(["models" => $interface->create($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function index(UserInterface $interface, Request $request)
    {
        return response()->json(["models" => $interface->read($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function show(UserInterface $interface, $id)
    {
        return response()->json(["models" => $interface->findById($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function update(Request $request, $id, UserInterface $interface)
    {
        return response()->json(["model" => $interface->update($request, $id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function destroy($id, UserInterface $interface)
    {
        return response()->json(["model" => $interface->delete($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function login(Request $request, UserInterface $interface)
    {
        return response()->json(["model" => $interface->login($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function logout(Request $request, UserInterface $interface)
    {
        return response()->json(["model" => $interface->logout($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function me(Request $request, UserInterface $interface)
    {
        return response()->json(["model" => $interface->me($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }
}

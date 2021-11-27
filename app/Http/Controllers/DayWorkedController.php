<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DayWorkedInterface;
use Illuminate\Http\Request;

class DayWorkedController extends Controller
{
    public function index(DayWorkedInterface $interface, Request $request)
    {
        return response()->json(["models" => $interface->read($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function show(DayWorkedInterface $interface, $id)
    {
        return response()->json(["models" => $interface->findById($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function update(Request $request, $id, DayWorkedInterface $interface)
    {
        return response()->json(["model" => $interface->update($request, $id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function destroy($id, DayWorkedInterface $interface)
    {
        return response()->json(["model" => $interface->delete($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function started_at(DayWorkedInterface $interface, Request $request)
    {
        return response()->json(["models" => $interface->started_at($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function break(DayWorkedInterface $interface, Request $request)
    {
        return response()->json(["models" => $interface->break($request), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function return(DayWorkedInterface $interface, $id)
    {
        return response()->json(["models" => $interface->return($id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }

    public function finished_at(Request $request, $id, DayWorkedInterface $interface)
    {
        return response()->json(["model" => $interface->finished_at($request, $id), "message" => $interface->getMessage()->text], $interface->getMessage()->code);
    }
}

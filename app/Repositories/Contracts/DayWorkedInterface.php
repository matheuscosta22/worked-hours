<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface DayWorkedInterface{
    public function getMessage();

    public function read(Request $request);
    public function create(Request $request);
    public function findById($id);
    public function delete($id);
    public function update(Request $request, $id);
}
<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface UserInterface
{
    public function getMessage();

    public function read(Request $request);
    public function findById($id);
    public function delete($id);
    public function create(Request $request);
    public function update(Request $request, $id);
    public function login(Request $request);
}
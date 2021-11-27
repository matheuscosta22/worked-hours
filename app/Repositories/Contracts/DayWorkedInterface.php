<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface DayWorkedInterface{
    public function getMessage();

    public function read(Request $request);
    public function findById($id);
    public function delete($id);
    public function update(Request $request, $id);
    
    public function started_at(Request $request);
    public function break(Request $request);
    public function return(Request $request);
    public function finished_at(Request $request);
}
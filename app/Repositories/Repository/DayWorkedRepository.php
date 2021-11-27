<?php

namespace App\Repositories\Repository;

use App\Models\DayWorked;
use App\Repositories\Contracts\DayWorkedInterface;
use App\Repositories\Repository\AbstractRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayWorkedRepository extends AbstractRepository implements DayWorkedInterface
{
    private $model = DayWorked::class;
    private $message;
    private $relationships = [];
    private $dependents = [];



    public function __construct()
    { 
        $this->model = app($this->model);
        parent::__construct($this->model, $this->message, $this->relationships, $this->dependents);
    }

    public function started_at(Request $request)
    {
        try{
            $model = new $this->model();
            $model->started_at = now();
            $model->id_user = Auth::user()->id;
            $model->save();
            $this->setMessage("Salvo com sucesso", 201);
            return $model;
        }catch(Exception $e){
            $this->setMessage('Erro encontrado com o código ' . $e, 500);
            return null;
        }
    }

    public function break(Request $request)
    {
        try{
            //dd(substr(now(), 0, 10));
            $model = DayWorked::where('id_user', Auth::user()->id)->get();
            dd($model);
            dd($model->where(substr($model->created_at, 0, 10), substr(now(), 0, 10)));

            $model->started_at = $request->started_at;
            $model->save();
            $this->setMessage("Salvo com sucesso", 201);
            return $model;
        }catch(Exception $e){
            $this->setMessage('Erro encontrado com o código ' . $e, 500);
            return null;
        }
    }

    public function return(Request $request)
    {
        try{

        }catch(Exception $e){
            $this->setMessage('Erro encontrado com o código ' . $e, 500);
            return null;
        }
    }

    public function finished_at(Request $request)
    {
        try{

        }catch(Exception $e){
            $this->setMessage('Erro encontrado com o código ' . $e, 500);
            return null;
        }
    }
}    